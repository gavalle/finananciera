<?php

namespace App\Http\Controllers;

use App\Models\PAAYear as ModelsPAAYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

class PAAYearController extends Controller
{

  
    public function years()
    {
        $years = ModelsPAAYear::query()->get();
        return response()->json($years);
    }    

    public function yearsSelect () {

        $years = ModelsPAAYear::query()
            ->select('id as id', 'cod as text')
            ->where('active',1)->get();

        return response()->json($years);
    }

    
    public function yearSave(Request $request)
    {
        $year = new ModelsPAAYear();
        $year->cod = $request->input('cod');
        $year->description = $request->input('description');
        $year->active = $request->input('active');

        $start_date_hiring= Carbon::parse($request->input('start_date_hiring'))->format('Y-m-d');
        $year->start_date_hiring = $start_date_hiring;

        $end_date_hiring= Carbon::parse($request->input('end_date_hiring'))->format('Y-m-d');
        $year->end_date_hiring = $end_date_hiring;

        $year->created_by = $request->user()->id;

        $year->save();
    
        return response()->json($year);
    
    }
    

    public function yearUpdate (Request $request)
    {
        $year = ModelsPAAYear::query()->where('id', $request->id)->first();
        $year->cod = $request->input('cod');
        $year->description = $request->input('description');
        $year->active = $request->input('active');

        $start_date_hiring= Carbon::parse($request->input('start_date_hiring'))->format('Y-m-d');
        $year->start_date_hiring = $start_date_hiring;

        $end_date_hiring= Carbon::parse($request->input('end_date_hiring'))->format('Y-m-d');
        $year->end_date_hiring = $end_date_hiring;

        $year->updated_by = $request->user()->id;

        $year->save();
    
        return response()->json($year);
    
    }


    public function year(Request $request)
    {
        $year = ModelsPAAYear::query()->where('id', $request->id)->first();
        return response()->json($year);
    }


    public function yearDelete(Request $request)
    {
        $year = ModelsPAAYear::query()->where('id', $request->id)->first();
        $year->delete();
        return response()->json($year);
    }

}
