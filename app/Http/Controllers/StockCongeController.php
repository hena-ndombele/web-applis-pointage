<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\StockConge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockCongeController extends Controller
{
    public function index(){
        $stocks= StockConge::All();
        //$grades = DB::table('agents')->distinct()->pluck('grade')->toArray();
        $grades=Grade::all();
      
        return view('stockConges.stockCongeList',compact('stocks','grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade_id' => 'required|integer',
            'totalConge' => 'required|integer',
        ]);    
        $stocks = StockConge::create([
            'grade_id' => $request->grade_id,
            'totalConge' => $request->totalConge,
        ]);
    
        return redirect()->route('stockConges.index');
    }

    public function destroy(StockConge $stockConge){
        $stockConge->delete();
        return redirect()->route('stockConges.index');

    }
}


