<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockFloorMapping extends Model
{
    use HasFactory;

    protected $table = 'block_floor_mappings';
    public $timestamps = false;
    protected $primaryKey = 'block_floor_map_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'project_id',
        'block_name_map_id',
        'total_floor',
        'initial_name',
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
