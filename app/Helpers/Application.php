<?php
namespace App\Helpers;

use Illuminate\Support\Carbon;
use Rmunate\Utilities\SpellNumber;

class Application
{
     protected static $authSessionName = "admin.auth";

     public $user;
     public $permissions;
     public $modules;
     public static function login($user)
     {
          $prefix = self::$authSessionName;
          $user = json_decode($user->toJson());
          $permissions = $user->roles?->permissions;
          $modules = self::moduleFromPermission($permissions, $user->roles->is_superadmin);

          $user->is_superadmin = $user->roles->is_superadmin;
          unset($user->password);
          unset($user->roles);
          session()->put("{$prefix}.user", $user);
          session()->put("{$prefix}.permissions", $permissions);
          session()->put("{$prefix}.modules", $modules);
          return new static;
     }

     public static function setUser($user)
     {
          $prefix = self::$authSessionName;
          $user = json_decode($user->toJson());
          $user->is_superadmin = $user->roles->is_superadmin;
          unset($user->password);
          unset($user->roles);
          session()->put("{$prefix}.user", $user);
     }

     public static function logout()
     {
          $prefix = self::$authSessionName;
          session()->forget("{$prefix}.user");
          session()->forget("{$prefix}.permissions");
          session()->forget("{$prefix}.modules");
     }
     public static function user()
     {
          $prefix = self::$authSessionName;
          $self = new static;
          $self->user = session("{$prefix}.user");
          $self->permissions = session("{$prefix}.permissions");
          $self->modules = session("{$prefix}.modules");
          return $self;
     }

     public static function moduleFromPermission($permissions, $isSuperadmin)
     {
          $modules = [];
          $allModules = config('modules');
          if ($isSuperadmin) {
               $modules = $allModules;
          } else {
               foreach ($allModules as $group => $menus) {
                    $groupMenus = [];
                    foreach ($menus as $menu) {
                         if (in_array("view:admin-{$menu['id']}", $permissions)) {
                              $groupMenus[] = $menu;
                         }
                    }
                    if (count($groupMenus)) {
                         $modules[$group] = $groupMenus;
                    }
               }
          }
          return $modules;
     }


     public static function countProgres($index, $totalData)
     {
          $value = round($index / $totalData * 100);
          return $value >= 100 ? 100 : $value;
     }

     public static function excelToDate($value)
     {
          if ($value) {
               if (gettype($value) === 'integer') {
                    return \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('Y-m-d');
               } else if (gettype($value) === 'string') {
                    try{
                         return Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
                    }catch(\Exception $e){
                         return $value;
                    }
               } else {
                    return date('Y-m-d', $value);
               }
          } else {
               return null;
          }
     }
}