<?php

namespace App\Http\Controllers\Admin\Developer;

use App\Helpers\Application;
use App\Http\Controllers\Controller;
use App\Models\Developer\UserAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AdminAuthenticationController extends Controller
{
    public function login(Request $request)
    {
        if (admin()->user) {
            return redirect(config('admin.home'));
        }
        return view("admin.developer.auth.login");
    }

    public function postLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        $user = UserAdmin::query()
            ->with('roles')
            ->whereEmail($request->email)
            ->select(['id', 'role_permission_id', 'name', 'email', 'profile', 'password'])
            ->first();
        if (!$user)
            throw ValidationException::withMessages(['email' => 'The users account is not found ']);

        if (!Hash::check($request->password, $user->password))
            throw ValidationException::withMessages(['password' => 'The password you entered does not match ']);

        Application::login($user);

        return redirect(config('admin.home'));
    }

    public function logout(Request $request)
    {
        Application::logout();

        return to_route('admin.auth.login');

    }
}
