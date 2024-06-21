<?php

namespace App\Http\Controllers\Admin\Utility;

use App\Http\Controllers\Controller;
use App\Services\Util\SettingService;
use Illuminate\Http\Request;

class AdminSettingController extends Controller
{
    protected $properties = ['efficiency_percentage'];
    public function index(Request $request, SettingService $settingService)
    {

        $setting = $settingService->findAll($this->properties);
        return view("admin.utility.setting", [
            "setting" => $setting
        ]);
    }

    public function store(Request $request, SettingService $settingService)
    {
        $request->validate([
            'efficiency_percentage' => 'required'
        ]);

        $settingService->store($request, $this->properties);
        return back()->with(['message' => "Successfully !"]);
    }


}
