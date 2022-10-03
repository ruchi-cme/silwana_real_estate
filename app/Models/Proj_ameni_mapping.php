<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proj_ameni_mapping extends Model
{
    use HasFactory;

    protected $table = 'proj_ameni_mappings';
    public $timestamps = false;
    protected $primaryKey = 'proj_ameni_mpg_id';

    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'project_id',
        'amenities_id',
        'status',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date'
    ];
}
