<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_address_detail extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'project_detail_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'project_id',
        'address',
        'landmark',
        'country',
        'state',
        'city',
        'zip',
        'latitude',
        'longitude',
        'status',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date'
    ];
}
