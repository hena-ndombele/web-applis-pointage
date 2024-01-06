<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home" style="color:black"></i>
        <p style="color:#ffffff;">Home</p>
    </a>
</li>
@permission('read','Agent')
<li class="nav-item">
    <a href="{{ route('agents.index') }}" class="nav-link {{ Request::is('agents') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user-plus" style="color:black"></i>
        <p style="color:#ffffff;">Employés</p>
    </a>
</li>
@endpermission

@permission('read','User')
<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users" style="color:black"></i>
        <p style="color:#ffffff;">Liste des employés</p>
    </a>
</li> 

@endpermission
</li>

@permission('read','Presence')
<li class="nav-item">
    <a href="{{ route('presences.index') }}" class="nav-link {{ Request::is('presences') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th" style="color:black"></i>
        <p style="color:#ffffff;">Présences</p>
    </a>
</li>


@endpermission

@permission('read','Service')
<li class="nav-item has-treeview {{ Request::is('conge*') ? 'menu-open active' : '' }}">
    <a href="#" class="nav-link" data-toggle="false">
        <i class="nav-icon fa fa-calendar" style="color:black"></i>
        <p style="color:#ffffff;">Extras<i class="right fa fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
    @permission('read','Direction')

        <li class="nav-item">
            <a href="{{ route('directions.index') }}"  class="nav-link {{ Request::is('directions') ? 'active' : '' }}">
                <i class="nav-icon fas fa-align-justify" style="color:black"></i>
                <p style="color:#ffffff;">Direction</p>
            </a>
        </li>
        @endpermission
        @permission('read','Departement')
        <li class="nav-item">
            <a href="{{ route('departements.index') }}"  class="nav-link {{ Request::is('departements') ? 'active' : '' }}">
                <i class="nav-icon fas fa-align-justify" style="color:black"></i>
                <p style="color:#ffffff;">Departement</p>
            </a>
        </li>
        @endpermission
        @permission('read','Service')
        <li class="nav-item">
            <a href="{{ route('services.index') }}"  class="nav-link {{ Request::is('services') ? 'active' : '' }}">
                <i class="nav-icon fas fa-align-justify" style="color:black"></i>
                <p style="color:#ffffff;">Services</p>
            </a>
        </li>
        @endpermission
    </ul>
</li>
@endpermission

<li class="nav-item has-treeview {{ Request::is('contrats*') ? 'menu-open active' : '' }}">
    <a href="#" class="nav-link" data-toggle="false">
        <i class="nav-icon fa fa-cog" style="color:black"></i>
        <p style="color:#ffffff;">Configuration<i class="right fa fa-angle-left"></i></p>
    </a>
    <ul class="nav nav-treeview">
     
      
      
        <li class="nav-item">
            <a href="{{ route('fonctions.index') }}"  class="nav-link {{ Request::is('fonctions') ? 'active' : '' }}">
                <i class="nav-icon fa fa-file-contract" style="color:black"></i>
                <p style="color:#ffffff;">Fonctions</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('grades.index') }}"  class="nav-link {{ Request::is('grades') ? 'active' : '' }}">
                <i class="nav-icon fa fa-file-contract" style="color:black"></i>
                <p style="color:#ffffff;">Grades</p>
            </a>
        </li>
        
      
       @permission('read','Role')
        <li class="nav-item">
            <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles') ? 'active' : '' }}">
                <i class="nav-icon fas fa-user-tag" style="color:black"></i>
                <p style="color:#ffffff;">Roles</p>
            </a>
        </li>
        @endpermission 
       <li class="nav-item">
            <a href="{{ route('qrcode') }}"  class="nav-link {{ Request::is('qrcode') ? 'active' : '' }}">
                <i class="nav-icon fas fa-expand" style="color:black"></i>
                <p style="color:#ffffff;">QrCode</p>
            </a>
        </li>
        @permission('read','Bssid')
        <li class="nav-item">
            <a href="{{ route('bssid.index') }}"  class="nav-link {{ Request::is('bssid') ? 'active' : '' }}">
                <i class="nav-icon fas fa-wifi" style="color:black"></i>
                <p style="color:#ffffff;">Adresse IP</p>
            </a>
        </li>
        @endpermission
    </ul>
</li>










