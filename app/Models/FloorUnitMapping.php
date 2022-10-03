<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FloorUnitMapping extends Model
{
    use HasFactory;

    protected $table = 'proj_floor_unit_mapping';
    public $timestamps = false;
    protected $primaryKey = 'proj_floor_unit_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'proj_block_floor_id',
        'category_id',
        'unit_name',
        'area_in_sq_feet',
        'total_price',
        'booking_price',
        'booking_type',
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
