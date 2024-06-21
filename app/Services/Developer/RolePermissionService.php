<?php
namespace App\Services\Developer;

use App\Models\Developer\RolePermission;
use App\Services\AdminService;
use Illuminate\Http\Request;

class RolePermissionService extends AdminService
{
     public function __construct(
          protected $model = RolePermission::class
     ) {
     }

     public function datatable(Request $request, $perPage)
     {
          $search = $request->search;
          return $this->model::query()
               ->when($search, fn($query) => $query->where(function ($query) use ($search) {
                    $query->where("name", "like", "%{$search}%");
                    $query->orWhere("permissions", "like", "%{$search}%");
               }))
               ->datatable($perPage, "created_at");
     }
     public function store(Request $request)
     {
          return $this->model::create(
               $request->only(['name', 'is_superadmin', 'permissions'])
          );
     }

     public function update(Request $request, $uuid)
     {
          return $this->model::whereUuid($uuid)
               ->update(
                    $request->only(['name', 'is_superadmin', 'permissions'])
               );
     }

     public function findAll()
     {
          return $this->model::select(['id', 'name'])->get();
     }
}