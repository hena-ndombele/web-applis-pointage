<?php

namespace App\Http\Controllers;

use App\Models\StockConge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockCongeController extends Controller
{
    public function index(){
        $stocks= StockConge::All();
        $grades = DB::table('agents')->distinct()->pluck('grade')->toArray();
        return view('stockConges.stockCongeList',compact('stocks','grades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'grade' => 'required|string|unique:stock_conges',
            'totalConge' => 'required|integer',
        ]);    
        $stocks = StockConge::create([
            'grade' => $request->grade,
            'totalConge' => $request->totalConge,
        ]);
    
        return redirect()->route('stockConges.index');
    }

    public function destroy(StockConge $stockConge){
        $stockConge->delete();
        return redirect()->route('stockConges.index');

    }
}


