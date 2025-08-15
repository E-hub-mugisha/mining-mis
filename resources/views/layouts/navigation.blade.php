<nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
    <div class="container-fluid">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-inline-block align-text-top" style="height: 36px;" />
        </a>

        <!-- Toggler/collapsible Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" 
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('dashboard')) active @endif" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('sites.*')) active @endif" href="{{ route('sites.index') }}">
                        Sites
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('users.*')) active @endif" href="{{ route('users.index') }}">
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('resource_items.*')) active @endif" href="{{ route('resource_items.index') }}">
                        Resource Items
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('equipment.*')) active @endif" href="{{ route('equipment.index') }}">
                        Equipment
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('fuel-logs.*')) active @endif" href="{{ route('fuel-logs.index') }}">
                        Fuel Logs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('maintenance.*')) active @endif" href="{{ route('maintenance.index') }}">
                        Maintenance
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('production-logs.*')) active @endif" href="{{ route('production-logs.index') }}">
                        Production Logs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('safety-incidents.*')) active @endif" href="{{ route('safety-incidents.index') }}">
                        Safety Incidents
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('stock-movements.*')) active @endif" href="{{ route('stock-movements.index') }}">
                        Stock Movements
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('attendance_logs.*')) active @endif" href="{{ route('attendance_logs.index') }}">
                        Attendance Logs
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(request()->routeIs('staff.*')) active @endif" href="{{ route('staff.index') }}">
                        Staff
                    </a>
                </li>
            </ul>

            <!-- User dropdown -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                Profile
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item" type="submit">
                                    Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
