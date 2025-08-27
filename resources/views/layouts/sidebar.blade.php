<div class="nk-sidebar nk-sidebar-fixed is-dark " data-content="sidebarMenu">
        <div class="nk-sidebar-element nk-sidebar-head">
                <div class="nk-menu-trigger">
                        <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu">
                                <em class="icon ni ni-arrow-left"></em>
                        </a>
                        <a href="#" class="nk-nav-compact nk-quick-nav-icon d-none d-xl-inline-flex"
                                data-target="sidebarMenu"><em class="icon ni ni-menu"></em></a></div>
                <div class="nk-sidebar-brand"><a href="{{ route('dashboard') }}"
                                class="logo-link nk-sidebar-logo">
                                <x-application-logo class="d-inline-block align-text-top" style="height: 36px;" />
                        </a></div>
        </div>
        <div class="nk-sidebar-element nk-sidebar-body">
                <div class="nk-sidebar-content">
                        <div class="nk-sidebar-menu" data-simplebar>
                                <ul class="nk-menu">
                                        <li class="nk-menu-heading">
                                                <h6 class="overline-title text-primary-alt">Use-Case Preview</h6>
                                        </li>
                                        <li class="nk-menu-item"><a href="{{ route('dashboard') }}"
                                                        class="nk-menu-link @if(request()->routeIs('dashboard')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-user-list"></em></span><span
                                                                class="nk-menu-text">Dashboard</span></a></li>
                                        <li class="nk-menu-item"><a href="{{ route('sites.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('sites.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-building"></em></span><span
                                                                class="nk-menu-text">Site Management</span></a>
                                        </li>

                                        <li class="nk-menu-item"><a href="{{ route('users.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('users.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-users"></em></span><span
                                                                class="nk-menu-text">User Management</span></a>
                                        </li>
                                        <li class="nk-menu-item"><a
                                                        href="{{ route('resource_items.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('resource_items.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-user-list"></em></span><span
                                                                class="nk-menu-text">Resource Items</span></a>

                                        </li>
                                        <li class="nk-menu-item"><a
                                                        href="{{ route('equipment.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('equipment.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-file-docs"></em></span><span
                                                                class="nk-menu-text">Equipment</span></a>

                                        </li>
                                        <li class="nk-menu-item"><a
                                                        href="{{ route('fuel-logs.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('fuel-logs.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-tranx"></em></span><span
                                                                class="nk-menu-text">Fuel Logs</span></a>

                                        </li>
                                        <li class="nk-menu-item"><a
                                                        href="{{ route('maintenance.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('maintenance.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-grid-alt"></em></span><span
                                                                class="nk-menu-text">Maintenance</span></a>

                                        </li>
                                        <li class="nk-menu-item"><a
                                                        href="{{ route('production-logs.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('production-logs.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-file-docs"></em></span><span
                                                                class="nk-menu-text">Production Logs</span></a>

                                        </li>
                                        <li class="nk-menu-item"><a
                                                        href="{{ route('safety-incidents.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('safety-incidents.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-card-view"></em></span><span
                                                                class="nk-menu-text">Safety Incidents</span></a>

                                        </li>
                                        <li class="nk-menu-item"><a
                                                        href="{{ route('stock-movements.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('stock-movements.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-view-col"></em></span><span
                                                                class="nk-menu-text">Stock Movements</span></a></li>
                                        <li class="nk-menu-item"><a
                                                        href="{{ route('attendance_logs.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('attendance_logs.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-img"></em></span><span
                                                                class="nk-menu-text">Attendance Logs</span></a></li>

                                        <li class="nk-menu-item"><a href="{{ route('staff.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('staff.*')) active @endif"><span
                                                                class="nk-menu-icon"><em
                                                                        class="icon ni ni-signin"></em></span><span
                                                                class="nk-menu-text">Staff</span></a>

                                        </li>
                                        <li class="nk-menu-item">
                                                <a href="{{ route('reports.index') }}"
                                                        class="nk-menu-link @if(request()->routeIs('reports.*')) active @endif">
                                                        <span class="nk-menu-icon">
                                                                <em class="icon ni ni-report-profit"></em>
                                                        </span>
                                                        <span class="nk-menu-text">Reports</span>
                                                </a>
                                        </li>

                                </ul>
                        </div>
                </div>
        </div>
</div>