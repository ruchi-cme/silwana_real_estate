<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;
    protected $table = 'proj_block_mappings';
    public $timestamps = false;
    protected $primaryKey = 'proj_block_map_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'project_id',
        'block_name',
        'floor',
        'category_id',
        'facing_text',
        'image',
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
