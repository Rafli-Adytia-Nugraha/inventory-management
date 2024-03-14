<header class="navbar navbar-expand-md navbar-light d-print-none">
  <div class="container-xl">
    <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3"></h1>
    <div class="navbar-nav flex-row order-md-last">
      <div class="nav-item dropdown">
        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
          <span class="avatar avatar-sm" style="background-image: url({{ asset('favicon.png') }})"></span>
          <div class="d-none d-xl-block ps-2">
            {{-- <div>{{ Auth::user()->name }}</div> --}}
            <div>{{ 0 }}</div>
            {{-- <div class="mt-1 small text-muted">{{ Auth::user()->username }}</div> --}}
            <div class="mt-1 small text-muted">{{ 0 }}</div>
          </div>
        </a>
        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
          {{-- <a class="nav-link main dropdown-item" href="{{ route('user.edit',Auth::user()->id) }}">Edit Profile</a> --}}
          <a class="nav-link main dropdown-item" href="{{ route('logout.index') }}">Logout</a>
        </div>
      </div>
    </div>
  </div>
</header>