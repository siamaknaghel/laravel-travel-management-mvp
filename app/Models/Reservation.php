<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'subservice_id',
        'origin_country_id',
        'origin_province_id',
        'origin_city_id',
        'destination_country_id',
        'destination_province_id',
        'destination_city_id',
        'travel_date',
        'price',
        'status',
        'notes',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function subservice()
    {
        return $this->belongsTo(Subservice::class);
    }

    public function originCountry()
    {
        return $this->belongsTo(Country::class, 'origin_country_id');
    }

    public function originProvince()
    {
        return $this->belongsTo(Province::class, 'origin_province_id');
    }

    public function originCity()
    {
        return $this->belongsTo(City::class, 'origin_city_id');
    }

    public function destinationCountry()
    {
        return $this->belongsTo(Country::class, 'destination_country_id');
    }

    public function destinationProvince()
    {
        return $this->belongsTo(Province::class, 'destination_province_id');
    }

    public function destinationCity()
    {
        return $this->belongsTo(City::class, 'destination_city_id');
    }
}
