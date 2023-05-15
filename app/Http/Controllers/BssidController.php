<?php

namespace App\Http\Controllers;

use App\Models\Bssid;
use Illuminate\Http\Request;

class BssidController extends Controller
{
    public function index(){
        $bssid = Bssid::All();
        return view('bssid.bssidList',compact('bssid'));
    }

    public function store(Request $request){
        $bssid = Bssid::create([
            'name'=>$request->name,
            'bssid'=>$request->bssid,
        ]);

        return redirect()->route('bssid.index');
    }
    public function destroy(Bssid $bssid)
    {
        $bssid->delete();

        return redirect()->route('bssid.index');
    }


}
