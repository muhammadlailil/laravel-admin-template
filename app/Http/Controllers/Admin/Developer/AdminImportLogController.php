<?php

namespace App\Http\Controllers\Admin\Developer;

use App\Http\Controllers\Admin\AdminController;
use App\Services\Developer\ImportLogService;
use Illuminate\Http\Request;

class AdminImportLogController extends AdminController
{
    protected $moduleId = "global";
    protected $routePath = "admin.import-log";
    protected $pageTitle = "Import History";
    protected $resourcePath = "admin.developer.import-logs";
    protected $tableColumns = [
        "Date" => "created_at",
        "Filename" => "filename",
        "Import By" => "upload_by",
        "Data" => "total_data",
        "Progress" => "progress",
        "Insert" => "total_insert",
        "Update" => "total_update",
        "Skip" => "total_skip",
        "Failed" => "total_data"
    ];
    protected $formView = "popup";
    protected $add = false;
    protected $bulkAction = false;
    protected $tableAction = false;
    protected $moduleService = ImportLogService::class;

    public function index(Request $request)
    {
        $request->merge([
            'module' => $request->route('category')
        ]);
        return parent::index($request);
    }

}
