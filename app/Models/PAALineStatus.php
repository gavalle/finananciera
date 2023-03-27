<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PAALineStatus extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    public $table = 'paa_line_status';
    protected $with = [];
    protected $fillable = ['name','description','created_by'];
}
