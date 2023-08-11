<?php

namespace Modules\Notivication\app\Models;

use App\Models\User;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notivication extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'model',
        'route',
        'user_id',
        'target',
        'status', // unread, read
    ];

    protected static function newFactory()
    {
        return \Modules\Notivication\Database\factories\NotivicationFactory::new();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
