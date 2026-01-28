<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = [
        'booking_code',
        'customer_name',
        'customer_phone',
        'customer_email',
        'visit_date',
        'visit_time',
        'tickets',
        'menu_items',
        'notes',
        'payment_method',
        'agree_terms',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'visit_time' => 'string',
        'tickets' => 'array',
        'menu_items' => 'array',
        'agree_terms' => 'boolean',
    ];
}
