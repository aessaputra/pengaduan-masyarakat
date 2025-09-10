<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'resident_id',
        'report_category_id',
        'title',
        'description',
        'image',
        'latitude',
        'longitude',
        'address',
        'phone_number'
    ];

    public function resident()
    {
        // satu laporan dimiliki oleh satu resident
        return $this->belongsTo(Resident::class);
    }

    public function reportCategory()
    {
        // satu lapran dimiliki oleh satu category
        return $this->belongsTo(ReportCategory::class);
    }

    public function reportStatuses()
    {
        return $this->hasMany(ReportStatus::class);
    }

    public function latestStatus()
    {
        return $this->hasOne(ReportStatus::class)->latestOfMany();
    }
}
