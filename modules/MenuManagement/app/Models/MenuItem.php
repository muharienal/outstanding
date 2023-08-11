<?php

namespace Modules\MenuManagement\app\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use Uuid, HasFactory;

    protected $fillable = ['name', 'icon', 'route', 'status', 'permission_name', 'menu_group_id', 'posision'];

    protected $casts = ['status' => 'boolean'];

    protected static function newFactory()
    {
        return \Modules\MenuManagement\Database\factories\MenuItemFactory::new();
    }
}
