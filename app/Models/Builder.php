<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Builder extends Model
{
    use HasFactory;
    protected $table = 'builders';
    public $timestamps = false;
    protected $primaryKey = 'builder_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'company_name',
        'builder_email',
        'owner_name',
        'details',
        'address',
        'status',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
        'deleted',
        'deleted_date',
        'deleted_by'
    ];
}
