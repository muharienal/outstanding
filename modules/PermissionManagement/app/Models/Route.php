<?php

namespace Modules\PermissionManagement\app\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    use HasFactory;

    protected $fillable = ['route', 'permission_name', 'status', 'description'];

    protected $casts = ['status' => 'boolean'];

    protected static function newFactory()
    {
        return \Modules\PermissionManagement\Database\factories\RouteFactory::new();
    }
}
