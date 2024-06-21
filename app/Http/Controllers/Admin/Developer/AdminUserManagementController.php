<?php

namespace App\Http\Controllers\Admin\Developer;

use App\Http\Controllers\Admin\AdminController;
use App\Services\Developer\RolePermissionService;
use App\Services\Developer\UserAdminService;
use Illuminate\Http\Request;

class AdminUserManagementController extends AdminController
{
    protected $moduleId = "user-management";
    protected $routePath = "admin.user-management";
    protected $pageTitle = "Users Management";
    protected $resourcePath = "admin.developer.user-management";
    protected $tableColumns = [
        "Email" => "id",
        "Nama" => "name",
        "Role" => "name",
    ];
    protected $moduleService = UserAdminService::class;
    protected $bulkAction = false;

    protected $rules = [
        "name" => "required",
        "role_permission_id" => "required",
    ];

    protected $createRules = [
        "password" => "required|min:6",
        "email" => "required|unique:cms_admins,email"
    ];

    protected $updateRules = [
        "email" => "unique:cms_admins,email,{id},uuid",
    ];
    public function create(Request $request)
    {
        $this->data = [
            'roles' => (new RolePermissionService)->findAll()
        ];
        return parent::create($request);
    }

    public function edit(Request $request, $uuid)
    {

        $this->data = [
            'roles' => (new RolePermissionService)->findAll()
        ];
        return parent::edit($request, $uuid);
    }
}
