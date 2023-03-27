<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PAAYear extends Model
{
    use HasFactory,SoftDeletes;

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];


    public $table = 'years';
	protected $with = [];
    protected $fillable = ['cod','description','start_date_hiring','end_date_hiring','active','created_by'];
}
