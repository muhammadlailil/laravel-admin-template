<?php

namespace App\Http\Controllers\Admin\Utility;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Controller;
use App\Services\Util\NotificationService;
use Illuminate\Http\Request;

class AdminNotificationController extends AdminController
{
    protected $moduleId = "global";
    protected $routePath = "admin.notification";
    protected $pageTitle = "Notification";
    protected $resourcePath = "admin.utility.notification";
    protected $tableColumns = [
        "Date" => "created_at",
        "Title" => "title",
        "Description" => "description",
        "New" => "is_read",
    ];
    protected $add = false;
    protected $bulkAction = false;
    protected $moduleService = NotificationService::class;

    public function detail(Request $request,NotificationService $notificationService,$uuid){
        $notification = $notificationService->findByUuId($uuid);
        $notification->update(['is_read'=>true]);

        return back();
    }
}
