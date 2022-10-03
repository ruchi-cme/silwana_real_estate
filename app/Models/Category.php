<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'category_master';
    public $timestamps = false;
    protected $primaryKey = 'category_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array

     */
    protected $fillable = [

        'category_name',
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
