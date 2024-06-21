<?php
namespace App\Services\Developer;

use App\Models\Developer\UserAdmin;
use App\Services\AdminService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserAdminService extends AdminService
{
     public function __construct(
          protected $model = UserAdmin::class
     ) {
     }

     public function datatable(Request $request, $perPage)
     {
          $perPage = $request->get('limit', $perPage);
          $search = $request->search;
          return $this->model::query()
               ->with(['roles:id,name'])
               ->when($search, fn($query) => $query->where(function ($query) use ($search) {
                    $query->where("name", "like", "%{$search}%");
                    $query->orWhere("email", "like", "%{$search}%");
               }))
               ->datatable($perPage, "created_at");
     }
     public function store(Request $request)
     {
          $data = $request->only(['name', 'email','role_permission_id']);
          $data['password'] = Hash::make($request->password);
          $data['profile'] = "https://ui-avatars.com/api/?name={$request->name}&color=FFF&background=3A4141";
          return $this->model::create($data);
     }

     public function update(Request $request, $uuid)
     {
          $data = $request->only(['name', 'email','role_permission_id']);
          $data['profile'] = "https://ui-avatars.com/api/?name={$request->name}&color=FFF&background=3A4141";
          if ($request->password) {
               $data['password'] = Hash::make($request->password);
          }
          return $this->model::whereUuid($uuid)
               ->update($data);
     }
}