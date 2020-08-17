<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ScanDataCellular extends Model
{
    use SoftDeletes;

    public $table = 'scan_data_cellulars';

    protected $dates = [
        'date',
        'html_changed_datetime',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'date',
        'html',
        'html_changed_datetime',
        'provider_name',
        'package_name',
        'package_change_price',
        'parser',
        'package_month_price',
        'html_changed',
        'package_min_lines',
        'package_minutes',
        'package_sms',
        'package_gb',
        'package_sim_price',
        'package_sim_connection_price',
        'minutes_to_other_countries',
        'logo',
        'other_details',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function scopeFiltering($query, array $filters, int $i)
    {
        if ($filters['gb'][$i]) {
            $query->where('package_gb', '>=', $filters['gb'][$i]);
        }
        if ($filters['minutes'][$i]) {
            $query->where('package_minutes', '>=', $filters['minutes'][$i]);
        }
        if ($filters['sms'][$i]) {
            $query->where('package_sms', '>=', $filters['sms'][$i]);
        }
        if (isset($filters['price']) && $filters['price'][$i]) {
            $query->where('package_month_price', '<=', $filters['price'][$i]);
        }
        if ($filters['roaming'][$i]) {
            $query->where(function($query) use ($filters, $i){
                return $query->where('minutes_to_other_countries', '>=', $filters['roaming'][$i])->orWhereNull('minutes_to_other_countries');
            });
        }
        $query->where('package_min_lines', '<=', $filters['lines']);
        return $query;
    }

    public function setDateAttribute($value)
    {
        $this->attributes['date'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function getHtmlChangedDatetimeAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setHtmlChangedDatetimeAttribute($value)
    {
        $this->attributes['html_changed_datetime'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function scanDataCellularsUserDatas()
    {
        return $this->hasMany(UserData::class, 'scan_data_cellulars_id', 'id');
    }
}
