<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class PAALine extends Model implements Auditable
{
    use HasFactory,SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    protected $hidden = [
        'updated_at',
        'deleted_at'
    ];

    public $table = 'paa_lines';
    protected $with = [];
    protected $fillable = [
        'organizational_area_id',
        'organizational_area_cod',
        'organizational_area_name',
        'cod',
        'cod_paa_line',
        'description',
        'start_date_selection_process',
        'contract_duration',
        'contract_duration_unit_id',
        'contract_duration_unit_name',
        'selection_method_id',
        'selection_method_name',
        'source_funds_id',
        'source_funds_name',
        'total_amount',
        'value_current_period',
        'future_periods_required',
        'status_future_periods',
        'unit_responsible_id',
        'unit_responsible_name',
        'cod_paa_line_unit_responsible',
        'contractor_id',
        'contractor_identification',
        'contractor_name',
        'observations',
        'service_contract',
        'service_contract_type_id',
        'service_contract_type_name',
        'operating_value',
        'operating_budget',
        'investment_value',
        'investment_budget',
        'action_plan_indicator',
        'value_resources_other_sources',
        'paa_id',
        'status_id',
        'created_by',
        'created_at'
    ];

    public function status () {
        return $this->belongsTo(PAALineStatus::class, 'status_id', 'id');
    }

}
