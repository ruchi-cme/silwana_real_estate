<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $primaryKey = 'project_image_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'project_image_id',
        'project_id',
        'title',
        'path',
        'direction',
        'facing',
        'type',
        'status',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date'
    ];
}
