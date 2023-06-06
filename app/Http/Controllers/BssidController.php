<?php

namespace App\Http\Controllers;

use App\Models\Bssid;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class BssidController extends Controller
{
    public function index(){
        $bssid = Bssid::All();
        return view('bssid.bssidList',compact('bssid'));
    }

    public function store(Request $request){

        
        $qrcode = QrCode::size(200)->generate(
            "api/scan",
            "../public/storage/codes_qr/$request->name.svg"
        );

        $qr_codePath = "codes_qr/$request->name.svg";


        Bssid::create([
            'name'      => $request->name,
            'bssid'     => $request->bssid,
            'qr_code'   => $qr_codePath,
        ]);


        return redirect()->route('bssid.index');
    }
    public function destroy(Bssid $bssid)
    {
        $bssid->delete();

        return redirect()->route('bssid.index');
    }


}
