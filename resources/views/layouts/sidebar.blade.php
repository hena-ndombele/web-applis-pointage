<aside class="main-sidebar sidebar-dark elevation-4" style="background-color:#008B8B;">
    <a href="{{ route('home') }}" class="brand-link">
        <img src="{{Vite::asset('resources/images/logo.png')}}"
             alt="Logo"
             class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                @include('layouts.menu')
            </ul>
        </nav>
    </div>

</aside>
