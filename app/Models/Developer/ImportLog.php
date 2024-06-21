<?php

namespace App\Models\Developer;

use App\Traits\HasDatatable;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportLog extends Model
{
    use HasFactory, HasUuid, HasDatatable;

    protected $table = "cms_import_logs";
    protected $guarded = [];

    protected $appends = ['total_failed'];
    protected $casts = [
        'permissions' => 'array'
    ];

    protected function getTotalFailedAttribute()
    {
        $total = $this->total_data - ($this->total_insert + $this->total_update + $this->total_skip);
        return $total > 0 ? $total : 0;
    }
}
