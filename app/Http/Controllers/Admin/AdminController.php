<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ExportExcel;
use App\Http\Controllers\Controller;
use App\Traits\BadRequestException;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    protected $moduleId = "";
    protected $routePath;
    protected $pageTitle;
    protected $resourcePath;
    protected $moduleService;
    protected $tableColumns = [];
    protected $rules = [];
    protected $createRules = [];
    protected $updateRules = [];
    protected $tableAction = true;
    protected $add = true;
    protected $search = true;
    protected $filter = false;
    protected $import = false;
    protected $importSample = null;
    protected $export = false;
    protected $bulkAction = true;

    protected $bulkActions = [
        [
            'icon' => 'icon-trash',
            'action' => 'delete',
            'color' => 'text-[#B22041]',
            'label' => 'Delete',
            'target' => '_self'
        ]
    ];

    protected $formView = "new_page";

    protected $perPage = 10;
    protected $sorting = [];
    protected $data = [];
    protected $message = [];

    public function index(Request $request)
    {

        if (!itcan("view:admin-{$this->moduleId}")) {
            return to_route('admin.dashboard')->with(['message' => "You don't have access to this resource", "message_type" => "warning"]);
        }

        $this->data = [
            "pageTitle" => $this->pageTitle,
            "datatableViews" => "{$this->resourcePath}.table",
            "resourcePath" => $this->resourcePath,
            "tableColumns" => $this->tableColumns,
            "routePath" => $this->routePath,
            "formView" => $this->formView,
            "limit" => $request->get('limit',$this->perPage),
            "action" => [
                "tableAction" => $this->tableAction,
                "filter" => $this->filter,
                "import" => $this->import,
                "importSample" => $this->importSample ? asset($this->importSample) : null,
                "export" => $this->export,
                "sorting" => $this->sorting,
                "add" => $this->add,
                "search" => $this->search,
                "bulkAction" => $this->bulkAction,
                "bulkActions" => $this->bulkActions
            ],
            "data" => (new $this->moduleService)->datatable($request, $this->perPage),
            ...$this->data,
        ];

        return view("admin.default.table", $this->data);
    }

    public function create(Request $request)
    {
        if (!itcan("add:admin-{$this->moduleId}") || !$this->add) {
            return to_route('admin.dashboard')->with(['message' => "You don't have access to this resource", "message_type" => "warning"]);
        }

        $this->data = [
            "pageTitle" => $this->pageTitle,
            "formTitle" => "Add New {$this->pageTitle}",
            "routePath" => $this->routePath,
            "formAction" => route("{$this->routePath}.store"),
            "formViews" => "{$this->resourcePath}.create",
            "formType" => "create",
            "breadcrumb" => [
                [
                    "url" => route($this->routePath . ".index"),
                    "label" => "List {$this->pageTitle}"
                ],
                [
                    "url" => null,
                    "label" => "/ Add New"
                ]
            ],
            ...$this->data,
        ];

        return view("admin.default.form", $this->data);
    }

    public function edit(Request $request, $uuid)
    {
        if (!itcan("edit:admin-{$this->moduleId}")) {
            return to_route('admin.dashboard')->with(['message' => "You don't have access to this resource", "message_type" => "warning"]);
        }

        $this->data = [
            "pageTitle" => $this->pageTitle,
            "formTitle" => "Edit {$this->pageTitle}",
            "routePath" => $this->routePath,
            "formAction" => route("{$this->routePath}.update", $uuid),
            "formViews" => "{$this->resourcePath}.edit",
            "formType" => "update",
            "row" => (new $this->moduleService)->findByUuId($uuid),
            "breadcrumb" => [
                [
                    "url" => route($this->routePath . ".index"),
                    "label" => "List {$this->pageTitle}"
                ],
                [
                    "url" => null,
                    "label" => "/ Edit Data"
                ]
            ],
            "id" => $uuid,
            ...$this->data,
        ];

        return view("admin.default.form", $this->data);
    }

    public function show(Request $request, $uuid)
    {
        if (!itcan("view:admin-{$this->moduleId}")) {
            return to_route('admin.dashboard')->with(['message' => "You don't have access to this resource", "message_type" => "warning"]);
        }

        $this->data = [
            "pageTitle" => $this->pageTitle,
            "formTitle" => "Detail {$this->pageTitle}",
            "formViews" => "{$this->resourcePath}.show",
            "row" => (new $this->moduleService)->findByUuId($uuid),
            "breadcrumb" => [
                [
                    "url" => route($this->routePath . ".index"),
                    "label" => "List {$this->pageTitle}"
                ],
                [
                    "url" => null,
                    "label" => "/ Detail"
                ]
            ],
            ...$this->data,
        ];

        return view("admin.default.detail", $this->data);
    }


    public function store(Request $request)
    {
        if (!itcan("add:admin-{$this->moduleId}")) {
            return to_route('admin.dashboard')->with(['message' => "You don't have access to this resource", "message_type" => "warning"]);
        }
        $request->validate($this->validationRules('create'));

        try {
            (new $this->moduleService)->store($request);
            $successMessage = @$this->message['store'] ?: "{$this->pageTitle} successfully addedd";

            return redirect(return_url() ?: route("{$this->routePath}.index"))->with(['message' => $successMessage]);
        } catch (BadRequestException $e) {
            return redirect()->back()->withInput($request->input())->with(['message' => $e->getMessage(), 'message_type' => 'warning']);
        }
    }


    public function update(Request $request, $uuid)
    {
        if (!itcan("edit:admin-{$this->moduleId}")) {
            return to_route('admin.dashboard')->with(['message' => "You don't have access to this resource", "message_type" => "warning"]);
        }
        $request->validate($this->validationRules('update', $uuid));
        try {
            (new $this->moduleService)->update($request, $uuid);
            $successMessage = @$this->message['update'] ?: "{$this->pageTitle} successfully edited";

            return redirect(return_url() ?: route("{$this->routePath}.index"))->with(['message' => $successMessage]);
        } catch (BadRequestException $e) {
            return redirect()->back()->withInput($request->input())->with(['message' => $e->getMessage(), 'message_type' => 'warning']);
        }
    }

    public function destroy(Request $request, $id)
    {
        if (!itcan("delete:admin-{$this->moduleId}")) {
            return to_route('admin.dashboard')->with(['message' => "You don't have access to this resource", "message_type" => "warning"]);
        }
        try {
            (new $this->moduleService)->deleteByUuid($id);

            $successMessage = @$this->message['delete'] ?: "{$this->pageTitle} successfully deleted";
            return redirect(return_url() ?: route("{$this->routePath}.index"))->with(['message' => $successMessage]);
        } catch (BadRequestException $e) {
            return redirect()->back()->with(['message' => $e->getMessage(), 'message_type' => 'warning']);
        }
    }

    public function bulkAction(Request $request)
    {
        if($request->action_type=='delete'){
            if (!itcan("delete:admin-{$this->moduleId}") || !$this->bulkAction) {
                return to_route('admin.dashboard')->with(['message' => "You don't have access to this resource", "message_type" => "warning"]);
            }
    
            $selectedUuid = $request->selected_uuid;
            (new $this->moduleService)->bulkDeleteByUuid($selectedUuid);
    
            $successMessage = @$this->message['bulk_delete'] ?: "{$this->pageTitle} successfully deleted";
            return redirect(return_url() ?: route("{$this->routePath}.index"))->with(['message' => $successMessage]);
        }       
        return $this->actionSelected($request);
    }

    public function actionSelected(Request $request)
    {
        return redirect(return_url() ?: route("{$this->routePath}.index"))->with(['success' => "Not implement",]);
    }

    public function exportData(Request $request)
    {
        if (!itcan("add:admin-{$this->moduleId}") || !$this->export) {
            return to_route('admin.dashboard')->with(['message' => "You don't have access to this resource", "message_type" => "warning"]);
        }

        $data = (new $this->moduleService)->datatable($request, null);
        return Excel::download(new ExportExcel([
            'view' => "{$this->resourcePath}.export",
            'data' => $data,
        ]), "{$request->file_name}.xls", \Maatwebsite\Excel\Excel::XLSX);
    }

    private function validationRules($type, $id = null)
    {
        $rules = ($type == 'create')
            ? $this->createRules
            : $this->updateRules;

        foreach ($rules as $input => $rule) {
            $separator = (@$this->rules[$input]) ? "|" : "";
            $this->rules[$input] = @$this->rules[$input] . $separator . $rule;
        }

        return collect($this->rules)->map(function ($item) use ($id) {
            return str_replace('{id}', $id, $item);
        })->toArray();
    }


}
