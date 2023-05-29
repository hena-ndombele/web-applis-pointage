<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('presences.index') }}" class="nav-link {{ Request::is('presences') ? 'active' : '' }}">
        <i class="nav-icon fas fa-th"></i>
        <p>Présences</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('bssid.index') }}"  class="nav-link {{ Request::is('bssid') ? 'active' : '' }}">
        <i class="nav-icon fas fa-wifi"></i>
        <p>Bssid</p>
    </a>
</li>
<li class="nav-item">
    <a href="{{ route('absences.index') }}"  class="nav-link {{ Request::is('absences') ? 'active' : '' }}">
        <i class="nav-icon fas fa-minus"></i>
        <p>Absences</p>
    </a>
</li>
