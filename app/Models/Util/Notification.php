<?php

namespace App\Models\Util;

use App\Traits\HasDatatable;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory, HasUuid, HasDatatable;

    protected $table = "notifications";
    protected $guarded = [];

    protected $casts = [
        'data' => 'array'
    ];
}
