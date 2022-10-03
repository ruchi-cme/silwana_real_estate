<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SilwanaDetailMapping extends Model
{
    use HasFactory;
    protected $table = 'silwana_details_mapping';
    public $timestamps = false;
    protected $primaryKey = 'silwana_dtl_mpg_id';
    /**
     * The attributes that are mass assignable.
     * @var array
     */
    protected $fillable = [

        'silwana_detail_id',
        'icon',
        'heading',
        'heading_detail',
        'heading_image',
        'status',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date'
    ];
}
