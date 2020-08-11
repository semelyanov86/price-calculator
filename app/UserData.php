<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class UserData extends Model
{
    use SoftDeletes;

    public $table = 'user_datas';

    const TYPE_SELECT = [
        'none'     => 'None',
        'cellular' => 'Cellular',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'type',
        'data',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function scan_data_cellulars()
    {
        return $this->belongsToMany(ScanDataCellular::class);
    }
}
