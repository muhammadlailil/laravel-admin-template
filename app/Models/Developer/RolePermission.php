<?php

namespace App\Models\Developer;

use App\Traits\HasDatatable;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    use HasFactory, HasUuid,HasDatatable;

    protected $table = "cms_permissions";
    protected $guarded = [];

    protected $casts = [
        'permissions' => 'array'
    ];

}
