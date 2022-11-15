<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestService extends Model
{
    use HasFactory;
    public $timestamps    = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'sub_title',
        'detail',
        'image',
        'created_by',
        'created_date',
        'modified_by',
        'modified_date'
    ];
}
