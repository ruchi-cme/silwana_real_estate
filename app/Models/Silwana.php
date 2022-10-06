<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Silwana extends Model
{
    use HasFactory;
    protected $table = 'silwana_detail_master';
    public $timestamps = false;
    protected $primaryKey = 'silwana_detail_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

        'page',
        'detail',
        'page_id',
        'page_image',
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
