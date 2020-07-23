<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ScanQueue extends Model
{
    use SoftDeletes;

    public $table = 'scan_queues';

    const TYPE_SELECT = [
        'none'     => 'None',
        'cellular' => 'Cellular',
    ];

    protected $dates = [
        'scan_datetime',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'scan_url',
        'scan_parameters',
        'scan_finished',
        'scan_datetime',
        'request',
        'response_code',
        'response_html',
        'type',
        'proxy_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getScanDatetimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setScanDatetimeAttribute($value)
    {
        $this->attributes['scan_datetime'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function proxy()
    {
        return $this->belongsTo(ScanProxy::class, 'proxy_id');
    }
}
