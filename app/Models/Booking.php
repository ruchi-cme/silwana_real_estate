<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'booking_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'booking_id',
        'user_id',
        'unit_id',
        'booking_price',
        'booking_details',
        'first_name',
        'last_name',
        'phone',
        'email',
        'booking_type',
        'payment_type',
        'status',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
        'canceled',
        'canceled_date',
        'canceled_by'
    ];

}
