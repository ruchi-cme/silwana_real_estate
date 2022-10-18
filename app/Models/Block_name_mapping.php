<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block_name_mapping extends Model
{
    use HasFactory;
    protected $table = 'block_name_mappings';
    public $timestamps = false;
    protected $primaryKey = 'block_name_map_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [
        'proj_block_map_id',
        'project_id',
        'block_name',
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
