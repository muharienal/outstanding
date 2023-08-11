<?php

namespace Modules\UserManagement\app\Models;

use App\Models\User;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Validation extends Model
{
    use Uuid, HasFactory;

    protected $fillable = [
        'img_self',
        'img_card',
        'user_id',
        'status',
    ];

    protected static function newFactory()
    {
        return \Modules\UserManagement\Database\factories\ValidationFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
