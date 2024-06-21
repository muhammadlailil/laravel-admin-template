<?php

namespace App\Http\Controllers\Admin\Developer;

use App\Http\Controllers\Admin\AdminController;
use App\Services\Developer\RolePermissionService;
use Illuminate\Http\Request;

class AdminManagePermissionController extends AdminController
{
    protected $moduleId = "module-superadmin";
    protected $routePath = "admin.role-permission";
    protected $pageTitle = "Roles & Permission";
    protected $resourcePath = "admin.developer.role-permission";
    protected $tableColumns = [
        "Nama" => "name",
        "Is Superadmin" => "is_superadmin"
    ];
    protected $moduleService = RolePermissionService::class;
    protected $bulkAction = false;

    public function create(Request $request)
    {
        $this->data = [
            'modules' => $this->findAllModule()
        ];
        return parent::create($request);
    }

    public function edit(Request $request, $uuid)
    {

        $this->data = [
            'modules' => $this->findAllModule()
        ];
        return parent::edit($request, $uuid);
    }


    private function findAllModule()
    {
        $modules = [];
        collect(config('modules'))->each(function ($menus, $group) use (&$modules) {
            $modules = [
                ...$modules,
                ...$menus
            ];
        });
        return $modules;
    }
}
