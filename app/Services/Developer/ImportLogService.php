<?php
namespace App\Services\Developer;

use App\Models\Developer\ImportLog;
use App\Services\AdminService;
use Illuminate\Http\Request;

class ImportLogService extends AdminService
{
     public function __construct(
          protected $model = ImportLog::class
     ) {
     }

     public function datatable(Request $request, $perPage)
     {
          $search = $request->search;
          return $this->model::query()
               ->when($search, fn($query) => $query->whereLike(["filename", "upload_by"], $search))
               ->where('module', $request->module)
               ->datatable($perPage, "created_at");
     }
}