@extends('layouts.app')
@section('content')

<div class="content">
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1></h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Présences</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
           <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-center mb-4">Code QR d'entrée</h6>
                            <img id="image" src="{{ asset('storage/' . $bssid->qr_code_1)  }}"  class="mx-auto d-block">
                           <p class="text-center mt-3"> <a class="btn btn-success btn-sm mr-2 "  href="{{ route('printQrCode1', $bssid->id) }} }}" target="_blank"   ><i class="fas fa-print"></i></a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-center mb-4">Code QR de sortie</h6>
                            <img id="image" src="{{ asset('storage/' . $bssid->qr_code_2)  }}" class="mx-auto d-block">
                            <p class="text-center mt-3"> <a class="btn btn-success btn-sm mr-2 "  href="{{ route('printQrCode2', $bssid->id) }} }}" target="_blank"   ><i class="fas fa-print"></i></a></p>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </section>

@endsection