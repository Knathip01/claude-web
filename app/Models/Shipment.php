<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'tracking_number',
        'customer_name',
        'customer_email',
        'destination',
        'status',
        'shipped_at'
    ];
}
