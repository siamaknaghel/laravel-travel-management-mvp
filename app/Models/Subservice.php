<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subservice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'service_id',
        'description',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
