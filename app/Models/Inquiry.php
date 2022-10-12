<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;
    public $timestamps = false;


    protected $fillable = [

        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
        'status',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date'
    ];
}
