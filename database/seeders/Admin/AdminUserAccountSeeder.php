<?php

namespace Database\Seeders\Admin;

use App\Models\Developer\RolePermission;
use App\Models\Developer\UserAdmin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permission = RolePermission::create([
            'name' => 'Superadmin',
            'is_superadmin' => true,
            'permissions' => [
                "view:admin-dashboard",
                "add:admin-dashboard",
                "edit:admin-dashboard",
                "delete:admin-dashboard",
                "view:admin-attendance",
                "add:admin-attendance",
                "edit:admin-attendance",
                "delete:admin-attendance",
                "view:admin-report-sales",
                "add:admin-report-sales",
                "edit:admin-report-sales",
                "delete:admin-report-sales",
                "view:admin-user-management",
                "add:admin-user-management",
                "edit:admin-user-management",
                "delete:admin-user-management"
            ]
        ]);
        UserAdmin::create([
            'name' => 'Admin Portal',
            'email' => 'portal@admin.com',
            'profile' => 'https://ui-avatars.com/api/?name=AdminPoral&color=FFF&background=3A4141',
            'password' => Hash::make('P@ssw0rd'),
            'role_permission_id' => $permission->id,
        ]);
    }
}