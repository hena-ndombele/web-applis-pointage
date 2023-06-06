<style>
    .container p{
        text-align: center !important;
    }
    .container img{
        width: 70% !important;
        height: 70% !important;
    }
</style>
<body onload="window.print();">
    <div class="container">
       <p> Code QR du wifi : {{$bssid->name}}</p> <br>
        <img id="image" src="{{ asset('storage/' . $bssid->qr_code)  }}" alt="{{$bssid->name}}">
    </div>
</body>