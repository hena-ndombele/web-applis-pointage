<nav class="main-header navbar navbar-expand navbar-white navbar-light">
  
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                    class="fas fa-bars"></i></a>
        </li>
    </ul>
    <h3 style="color:#008B8B;font-weight:bolder;">Tableau de bord</h3>
    <ul class="navbar-nav ml-auto" >
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{Vite::asset('resources/images/logo.png')}}"
                    class="user-image img-circle elevation-2" alt="User Image">
                <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right" >
                <!-- User image -->
                <li class="user-header " style="background: #008B8B;">
                    <img src="{{Vite::asset('resources/images/logo.png')}}"
                        class="img-circle elevation-2" alt="User Image">
                    @if(Auth::user())
                    <p style="color:white; font-weight:bold;">
                        {{ Auth::user()->name }}
                        <small>Membre dépuis {{ Auth::user()->created_at->format('M. Y') }}</small>
                    </p>
                    @endif
                </li>
                <!-- Menu Footer-->
                <li class="user-footer">
                    
                    <a href="#" class="btn btn-default btn-flat float-right" data-toggle="modal" data-target="#logoutModal"
                        >
                        Deconnexion
                    </a>
                   
                </li>
            </ul>
        </li>
    </ul>
    
</nav>


<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel" style="color: #008B8B;font-weight:bolder;">Déconnexion</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
        </div>
        <div class="modal-body">Êtes-vous sûr de vouloir vous déconnecter ?</div>
        <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal" style="background: red;color:white;">Annuler</button>
            <a class="btn " href="#" class="btn btn-default btn-flat float-right"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="background: #008B8B;color:white;">Se déconnecter</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
      
    </div>
</div>
</div>