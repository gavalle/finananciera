<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PAA extends Model
{
    use HasFactory,SoftDeletes;

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    public $table = 'paas';
    protected $with = [];
    protected $fillable = ['cod','name','description','paa_status_id','year_id','created_by'];


    public function status()
    {
        return $this->belongsTo(PAAStatus::class,'paa_status_id', 'id');
    }


    public function year()
    {
        return $this->belongsTo(PAAYear::class,'year_id', 'id');
    }
}
