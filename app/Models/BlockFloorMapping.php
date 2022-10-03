<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockFloorMapping extends Model
{
    use HasFactory;

    protected $table = 'proj_block_floor_dtl';
    public $timestamps = false;
    protected $primaryKey = 'proj_block_floor_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'proj_block_mapg_id',
        'category_id',
        'floor_no',
        'unit_count',
        'floor_detail',
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
