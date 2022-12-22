<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BrokerContactUs extends Model
{
    use HasFactory;
    protected $table = 'broker_contact_us';
    protected $fillable = array('*');

}
