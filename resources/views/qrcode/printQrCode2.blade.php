<style>
    body {
      height: 100vh;
    }
    .container {
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
      flex-direction: column;
    }
    #image {
      display: block;
      margin: 0 auto;
    }
    #image{
        width: 300px !important;
        height: 300px !important;
    }
  </style>
<body onload="window.print();">
    <div class="container">
       <h2> Code qr de sortie</h2> <br>
        <img id="image" src="{{ asset('storage/' . $bssid->qr_code_2)  }}" alt="{{$bssid->name}}">
    </div>
    
</body>