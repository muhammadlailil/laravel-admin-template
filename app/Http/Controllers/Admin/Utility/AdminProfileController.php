<?php

namespace App\Http\Controllers\Admin\Utility;

use App\Action\Profile\EditProfileAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = admin()->user;
        return view("admin.utility.profile.index",[
            'user' => $user
        ]);
    }

    public function about(Request $request)
    {
        return view("admin.utility.about",[
            'version' => config('admin.version'),
            'last_update' => config('admin.last_update'),
        ]);
    }


    public function store(Request $request,EditProfileAction $editProfileAction){
        $editProfileAction->execute($request,admin()->user?->id);

        return back()->with(['message' => 'Profile successfully Edited']);
    }

}
