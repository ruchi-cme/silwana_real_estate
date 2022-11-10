<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectAssign extends Model
{
    use HasFactory;
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'user_id',
        'project_id',
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
