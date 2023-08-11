<?php

namespace Modules\Report\app\Models;

use App\Models\User;
use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use Uuid, HasFactory;

    protected $fillable = [

        'tanggal_input',
        'tanggal_mulai',
        'show_status',
        'unit',
        'equipment',
        'program_kerja',
        'keterangan_pekerjaan',
        'status_pekerjaan',
        'progress',
        'target',
        'wo_number',
        'keterangan'    ,
        'scope_1',
        'scope_2',
        'pic',
        'prioritas',
        'upload_foto',
        'upload_document',
        'user_id',
    ];

    protected $hidden = [
        'user_id',
    ];

    protected $casts = [
        'upload_foto'       => 'array',
        'upload_document'   => 'array',
    ];

    protected static function newFactory()
    {
        return \Modules\Report\database\factories\Report\ReportFactory::new();
    }

    /**
     * attribute
     */
    public function uploadFoto(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value)
        );
    }

    public function uploadDocument(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value)
        );
    }

    /**
     * relation eloquent
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function has_drafter()
    {
        return $this->belongsTo(User::class, 'drafter');
    }

    /**
     * proced columns
     */
    public function getStatusColor()
    {
        $status_pekerjaan = $this->status_pekerjaan;

        switch ($status_pekerjaan) {
            case 'Rutin':
                return 'primary';
            case 'IP':
                return 'warning';
            case 'OK':
                return 'success';
            case 'Belum':
                return 'danger';
            default:
                return '';
        }
    }

    /**
     * prioritas
     */
    public function getPrioritasColor()
    {
        $prioritas = $this->prioritas;

        switch ($prioritas) {
            case 'Medium':
                return 'warning';
            case 'Low':
                return 'success';
            case 'High':
                return 'primary';
            case 'Emergency':
                return 'danger';
            default:
                return '';
        }
    }

    /**
     * show status
     */
    public function getshowColor()
    {
        $show_status = $this->show_status;

        switch ($show_status) {
            case 'Show':
                return 'success';
            case 'Hide':
                return 'danger';
            default:
                return '';
        }
    }
}
