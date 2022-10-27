<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorDetail extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = 'floor_detail_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'block_floor_map_id',
        'project_id',
        'category_id',
        'floor_no',
        'from',
        'to',
        'unit_count',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date',
        'deleted',
        'deleted_date',
        'deleted_by'
    ];
}
