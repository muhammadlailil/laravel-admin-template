<?php
namespace App\Services\Util;

use App\Models\Master\FactoryLine;
use App\Models\Util\Notification;
use App\Services\AdminService;
use Illuminate\Http\Request;

class NotificationService extends AdminService
{
     public function __construct(
          protected $model = Notification::class
     ) {
     }

     public function datatable(Request $request, $perPage)
     {
          $perPage = $request->get('limit', $perPage);
          $search = $request->search;
          return $this->model::query()
               ->when($search, fn($query) => $query->where(function ($query) use ($search) {
                    $query->where("title", "like", "%{$search}%");
                    $query->orWhere("description", "like", "%{$search}%");
               }))

               ->datatable($perPage, "created_at");
     }

     public function findTopNotification($limit = 10)
     {
          $query = $this->model::query()
               ->select(['title', 'description', 'data', 'uuid'])
               ->where('is_read', false)
               ->latest();
          $total = $query->clone()->count();
          $data = $query->clone()->limit($limit)->get();

          return (object) [
               'total' => $total,
               'items' => $data
          ];
     }
}