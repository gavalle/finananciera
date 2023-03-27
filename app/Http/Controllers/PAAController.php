<?php

namespace App\Http\Controllers;

use App\Models\PAA as ModelsPAA;
use App\Models\PAAStatus as ModelsPAAStatus;
use App\Models\PAALine as ModelsPAALine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class PAAController extends Controller
{

  
    public function paas()
    {
        $paas = ModelsPAA::with(['status', 'year'])->get();
        return response()->json($paas);
    }


    public function paasStatusSelect() {
        $paasStatus = ModelsPAAStatus::query()
            ->select('id as id', 'name as text')
            ->get();
        return response()->json($paasStatus);
    }


    public function paaLines(Request $request) {

        $paaLines = ModelsPAALine::query()->with('status')->where('paa_id',$request->id)->get();
        return response()->json($paaLines);
    }

    
    public function paaSave(Request $request)
    {
        $paa = new ModelsPAA();

        $paa->cod = $request->input('cod');
        $paa->name = $request->input('name');
        $paa->description = $request->input('description');
        $paa->paa_status_id = $request->input('paa_status_id');
        $paa->year_id = $request->input('year_id');
        $paa->created_by = $request->user()->id;

        $paa->save();
    
        return response()->json($paa);
    }

    public function paaLineSave(Request $request)
    {
        $paaLine = new ModelsPAALine();
        $countLines = ModelsPAALine::query()->where('paa_id', $request->input('paa_id'))->count();
        $paaLine->organizational_area_id = $request->input('organizational_area_id');
        $paaLine->organizational_area_cod = $request->input('organizational_area_cod');
        $paaLine->organizational_area_name = $request->input('organizational_area_name');
        $paaLine->cod = ++$countLines;
        $paaLine->cod_paa_line = $paaLine->organizational_area_cod . '-' . $paaLine->cod;
        $paaLine->unspsc = $request->input('unspsc');
        $paaLine->description = $request->input('description');
        $start_date_selection_process= Carbon::parse($request->input('start_date_selection_process'))->format('Y-m-d');
        $paaLine->start_date_selection_process = $start_date_selection_process;
        $paaLine->contract_duration = $request->input('contract_duration');
        $paaLine->contract_duration_unit_id = $request->input('contract_duration_unit_id');
        $paaLine->contract_duration_unit_name = $request->input('contract_duration_unit_name');
        $paaLine->selection_method_id = $request->input('selection_method_id');
        $paaLine->selection_method_name = $request->input('selection_method_name');
        $paaLine->source_funds_id = $request->input('source_funds_id');
        $paaLine->source_funds_name = $request->input('source_funds_name');
        $paaLine->total_amount = $request->input('total_amount');
        $paaLine->value_current_period = $request->input('value_current_period');
        $paaLine->future_periods_required = $request->input('future_periods_required');
        $paaLine->status_future_periods = $request->input('status_future_periods');
        $paaLine->unit_responsible_id = $request->input('unit_responsible_id');
        $paaLine->unit_responsible_name = $request->input('unit_responsible_name');
        $paaLine->unit_responsible_name = $request->input('unit_responsible_name');
        $paaLine->cod_paa_line_unit_responsible = $paaLine->unit_responsible_id . '-' . $paaLine->unit_responsible_name;
        $paaLine->contractor_id = $request->input('contractor_id');
        $paaLine->contractor_identification = $request->input('contractor_identification');
        $paaLine->contractor_name = $request->input('contractor_name');
        $paaLine->observations = $request->input('observations');
        $paaLine->service_contract = $request->input('service_contract');
        $paaLine->service_contract_type_id = $request->input('service_contract_type_id');
        $paaLine->service_contract_type_name = $request->input('service_contract_type_name');
        $paaLine->operating_value = $request->input('operating_value');
        $paaLine->operating_budget = $request->input('operating_budget');
        $paaLine->investment_value = $request->input('investment_value');
        $paaLine->investment_budget = $request->input('investment_budget');
        $paaLine->action_plan_indicator = $request->input('action_plan_indicator');
        $paaLine->value_resources_other_sources = $request->input('value_resources_other_sources');
        
        $paaLine->paa_id = $request->input('paa_id');
        $paaLine->status_id = 1;
        
        $paaLine->created_by = $request->user()->id;

        $paaLine->save();
    
        return response()->json($paaLine);
    }


    public function paaUpdate (Request $request)
    {
        $paa = ModelsPAA::query()->where('id', $request->id)->first();
        
        $paa->cod = $request->input('cod');
        $paa->name = $request->input('name');
        $paa->description = $request->input('description');
        $paa->paa_status_id = $request->input('paa_status_id');
        $paa->year_id = $request->input('year_id');
        $paa->updated_by = $request->user()->id;

        $paa->save();
    
        return response()->json($paa);
    
    }

    public function paaLineUpdate (Request $request)
    {
        $paaLine = ModelsPAALine::query()->where('id', $request->id)->first();
        $paaLine->organizational_area_id = $request->input('organizational_area_id');
        $paaLine->organizational_area_cod = $request->input('organizational_area_cod');
        $paaLine->organizational_area_name = $request->input('organizational_area_name');
        $paaLine->cod_paa_line = $paaLine->organizational_area_cod . '-' . $paaLine->cod;
        $paaLine->unspsc = $request->input('unspsc');
        $paaLine->description = $request->input('description');
        $start_date_selection_process= Carbon::parse($request->input('start_date_selection_process'))->format('Y-m-d');
        $paaLine->start_date_selection_process = $start_date_selection_process;
        $paaLine->contract_duration = $request->input('contract_duration');
        $paaLine->contract_duration_unit_id = $request->input('contract_duration_unit_id');
        $paaLine->contract_duration_unit_name = $request->input('contract_duration_unit_name');
        $paaLine->selection_method_id = $request->input('selection_method_id');
        $paaLine->selection_method_name = $request->input('selection_method_name');
        $paaLine->source_funds_id = $request->input('source_funds_id');
        $paaLine->source_funds_name = $request->input('source_funds_name');
        $paaLine->total_amount = $request->input('total_amount');
        $paaLine->value_current_period = $request->input('value_current_period');
        $paaLine->future_periods_required = $request->input('future_periods_required');
        $paaLine->status_future_periods = $request->input('status_future_periods');
        $paaLine->unit_responsible_id = $request->input('unit_responsible_id');
        $paaLine->unit_responsible_name = $request->input('unit_responsible_name');
        $paaLine->unit_responsible_name = $request->input('unit_responsible_name');
        $paaLine->cod_paa_line_unit_responsible = $paaLine->unit_responsible_id . '-' . $paaLine->unit_responsible_name;
        $paaLine->contractor_id = $request->input('contractor_id');
        $paaLine->contractor_identification = $request->input('contractor_identification');
        $paaLine->contractor_name = $request->input('contractor_name');
        $paaLine->observations = $request->input('observations');
        $paaLine->service_contract = $request->input('service_contract');
        $paaLine->service_contract_type_id = $request->input('service_contract_type_id');
        $paaLine->service_contract_type_name = $request->input('service_contract_type_name');
        $paaLine->operating_value = $request->input('operating_value');
        $paaLine->operating_budget = $request->input('operating_budget');
        $paaLine->investment_value = $request->input('investment_value');
        $paaLine->investment_budget = $request->input('investment_budget');
        $paaLine->action_plan_indicator = $request->input('action_plan_indicator');
        $paaLine->value_resources_other_sources = $request->input('value_resources_other_sources');      
        
        $paaLine->updated_by = $request->user()->id;

        $paaLine->save();
    
        return response()->json($paaLine);
    
    }


    public function paa(Request $request)
    {
        $paa = ModelsPAA::query()->where('id', $request->id)->first();
        return response()->json($paa);
    }

    public function paaLine(Request $request)
    {
        $paaLine = ModelsPAALine::query()->where('id', $request->line_id)->first();
        return response()->json($paaLine);
    }

    


    public function paaDelete(Request $request)
    {
        $paa = ModelsPAA::query()->where('id', $request->id)->first();
        $paa->delete();
        return response()->json($paa);
    }

    public function paaLineDelete(Request $request)
    {
        $paaLine = ModelsPAALine::query()->where('id', $request->line_id)->first();
        $paaLine->delete();
        return response()->json($paaLine);
    }

}
