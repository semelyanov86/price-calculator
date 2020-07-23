<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ScanProxy extends Model
{
    use SoftDeletes;

    public $table = 'scan_proxies';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'proxy_ip',
        'proxy_port',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function proxyScanQueues()
    {
        return $this->hasMany(ScanQueue::class, 'proxy_id', 'id');
    }
}
