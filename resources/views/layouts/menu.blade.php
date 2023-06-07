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
        <i class="fa-solid fa-dollar-sign"></i>
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
@endpermission
@permission('read','Bssid')
<li class="nav-item">
    <a href="{{ route('bssid.index') }}"  class="nav-link {{ Request::is('bssid') ? 'active' : '' }}">
        <i class="nav-icon fas fa-wifi"></i>
        <p>Bssid</p>
    </a>
</li>
@endpermission
