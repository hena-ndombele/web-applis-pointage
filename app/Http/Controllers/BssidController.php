<?php

namespace App\Http\Controllers;

use App\Models\Bssid;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;


class BssidController extends Controller
{
    public function index(){
        $bssid = Bssid::All();
        return view('bssid.bssidList',compact('bssid'));
    }

    public function store(Request $request)
    {
        $qrCode1 = QrCode::size(200)->generate("/api/scanArrive");
        $qrCode2 = QrCode::size(200)->generate("/api/scanDepart");

        $qrCodePath1 = "codes_qr/code1.svg";
        $qrCodePath2 = "codes_qr/code2.svg";

        Storage::disk('local')->put("public/$qrCodePath1", $qrCode1);
        Storage::disk('local')->put("public/$qrCodePath2", $qrCode2);

        Bssid::create([
            'name'      => $request->name,
            'bssid'     => $request->bssid,
            'qr_code_1' => $qrCodePath1,
            'qr_code_2' => $qrCodePath2,
        ]);

        return redirect()->route('bssid.index');
    }
    
    public function destroy(Bssid $bssid)
    {
        $bssid->delete();

        return redirect()->route('bssid.index');
    }

    public function printQrCode1(Bssid $bssid)
    {
        return view('qrcode.printQrCode1', compact('bssid'));
    }

    public function printQrCode2(Bssid $bssid)
    {
        return view('qrcode.printQrCode2', compact('bssid'));
    }


    public function listeQrCode()
    {
        $bssid = Bssid::firstOrFail();

        return view('qrcode.index', compact('bssid'));
    }
}
