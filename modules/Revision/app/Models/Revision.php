<?php

namespace Modules\Revision\app\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revision extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'name',
        'revisi',
        'infrastructure_id',
        // 'status',
    ];

    public function getStatusColor()
    {
        return $this->status->value === 'Pending' ? 'primary'
            : ($this->status->value === 'Processed' ? 'secondary'
                : ($this->status->value === 'Accepted' ? 'success'
                    : ($this->status->value === 'Rejected' ? 'warning'
                        : ($this->status->value === 'Closed' ? 'danger'
                            : ''))));
    }

    protected static function newFactory()
    {
        return \Modules\Revision\Database\factories\RevisionFactory::new();
    }
}
