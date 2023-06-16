<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>
@permission('read','Role')
<li class="nav-item">
    <a href="{{ route('roles.index') }}" class="nav-link {{ Request::is('roles.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-user"></i>
        <p>Roles</p>
    </a>
</li>
@endpermission
@permission('read','User')
<li class="nav-item">
    <a href="{{ route('users.index') }}" class="nav-link {{ Request::is('users.index') ? 'active' : '' }}">
        <i class="nav-icon fas fa-users"></i>
        <p>Liste des utlisateurs</p>
    </a>
</li> 

<li class="nav-item">
    <a href="{{ route('presences.index') }}" class="nav-link {{ Request::is('presences') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Présences</p>
    </a>
</li>


@include('layouts.bssidMenu');


</li>
@endpermission
</li>
@permission('read','Absence')
<li class="nav-item">
    <a href="{{ route('absences.index') }}"  class="nav-link {{ Request::is('absences') ? 'active' : '' }}">
        <i class="nav-icon fas fa-minus"></i>
        <p>Absences</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('taux.index') }}"  class="nav-link {{ Request::is('taux') ? 'active' : '' }}">
        <i class="nav-icon fa fa-dollar-sign"></i>
        <p>Taux</p>
    </a>
</li>

@endpermission
@permission('read','Presence')
<li class="nav-item">
    <a href="{{ route('presences.index') }}" class="nav-link {{ Request::is('presences') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Présences</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('conge.index') }}" class="nav-link {{ Request::is('conge') ? 'active' : '' }}">
        <i class="nav-icon fa fa-calendar"></i>
        <p>congés légaux</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('demandes.index') }}" class="nav-link {{ Request::is('demande') ? 'active' : '' }}">
        <i class="nav-icon fa fa-bell-o"></i>
        <p>Démandes de congé</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('bssid.index') }}"  class="nav-link {{ Request::is('bssid') ? 'active' : '' }}">
        <i class="nav-icon fas fa-wifi"></i>
        <p>Bssid</p>
    </a>
</li>
@endpermission
@permission('read','Bssid')
<li class="nav-item">
    <a href="{{ route('bssid.index') }}"  class="nav-link {{ Request::is('bssid') ? 'active' : '' }}">
        <i class="nav-icon fas fa-wifi"></i>
        <p>Bssid</p>
    </a>
</li>
@endpermission

@permission('read','Direction')
<li class="nav-item">
    <a href="{{ route('directions.index') }}"  class="nav-link {{ Request::is('directions') ? 'active' : '' }}">
        <i class="nav-icon fas fa-align-justify"></i>
        <p>Direction</p>
    </a>
</li>
@endpermission
@permission('read','Departement')
<li class="nav-item">
    <a href="{{ route('departements.index') }}"  class="nav-link {{ Request::is('departements') ? 'active' : '' }}">
        <i class="nav-icon fas fa-align-justify"></i>
        <p>Departement</p>
    </a>
</li>
@endpermission
@permission('read','Service')
<li class="nav-item">
    <a href="{{ route('services.index') }}"  class="nav-link {{ Request::is('services') ? 'active' : '' }}">
        <i class="nav-icon fas fa-align-justify"></i>
        <p>Services</p>
    </a>
</li>
@endpermission
<li class="nav-item">
    <a href="{{ route('contrats.index') }}"  class="nav-link {{ Request::is('contrats') ? 'active' : '' }}">
        <i class="nav-icon fa fa-file-contract"></i>
        <p>Contrats</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('horaires.index') }}"  class="nav-link {{ Request::is('horaires') ? 'active' : '' }}">
        <i class="nav-icon fa fa-clock"></i>
        <p>Horaires</p>
    </a>
</li>

