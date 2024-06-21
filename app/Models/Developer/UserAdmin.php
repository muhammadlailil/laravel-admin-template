<?php

namespace App\Models\Developer;

use App\Traits\HasDatatable;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAdmin extends Model
{
    use HasFactory, HasUuid,HasDatatable;

    protected $table = "cms_admins";
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsTo(RolePermission::class, 'role_permission_id', 'id');
    }
}
