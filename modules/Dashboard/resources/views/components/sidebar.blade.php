<div id="sidebar-menu" class="vertical-menu">
    <!-- Logo -->
    <div class="navbar-brand-box" style="background-color: white; margin-left: -17px; margin-top: 15px;">
        <a href="{{ route('dashboard.index') }}" class="logo logo-light">
            <img src="/assets/images/logo_project.webp" alt="" height="110">
        </a>
    </div>
    <!-- Left Menu Start -->
    <ul class="metismenu list-unstyled mt-5 mm-show" id="side-menu" style="zoom: 0.9;">
        @foreach ($menus as $menu)
            @can($menu->permission_name)
                @foreach ($menu->items as $item)
                    @can($item->permission_name)
                        <li class="nav-item">
                            <a class="nav-link menu-link{{ request()->routeIs($item->route) ? ' active' : '' }}"
                            href="{{ route($item->route) }}">
                                <i class="{{ $item->icon }}"></i> <span data-key="t-landing">{{ $item->name }}</span>
                            </a>
                        </li>
                    @endcan
                    <!-- end can item -->
                @endforeach
                <!-- end foreach items -->
            @endcan
            <!-- end can menu -->
        @endforeach
    </ul>
    <div class="sidebar-image" style="position: absolute; bottom: 0; left: 0; width: 100%; text-align: center;">
        <img src="/assets/images/sidebar-down.webp" alt="Sidebar Image" class="img-fluid">
    </div>
</div>

<style>
    .vertical-menu {
    width: 220px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 100;
    background-color: #FFF !important;
    }

    /* Default style for inactive menu items */
    ul.metismenu li.nav-item a.nav-link.menu-link span {
        color: var(--neutral-dark-hover, #999);
        font-size: 14px;
        font-style: normal;
        font-weight: 500;
    }

    ul.metismenu li.nav-item a.nav-link.menu-link:hover span {
        color: #07834D !important;
    }

    /* Style for active menu items */
    ul.metismenu li.nav-item a.nav-link.menu-link.active span {
        color: #07834D !important;
    }

    ul.metismenu li.nav-item a.nav-link.menu-link,
    ul.metismenu li.nav-item a.nav-link.menu-link i {
        color: var(--neutral-dark-hover, #999);
    }

    ul.metismenu li.nav-item a.nav-link.menu-link:hover,
    ul.metismenu li.nav-item a.nav-link.menu-link:hover i {
        color: #07834D !important;
    }

    ul.metismenu li.nav-item a.nav-link.menu-link.active,
    ul.metismenu li.nav-item a.nav-link.menu-link.active i {
        color: #07834D !important;
    }

    ul.metismenu li.nav-item a.nav-link.menu-link {
        position: relative;
    }

    ul.metismenu li.nav-item a.nav-link.menu-link.active {
        background: #EFEFEF;
    }

    ul.metismenu li.nav-item a.nav-link.menu-link.active::before {
        content: "";
        position: absolute;
        width: 8px;
        height: 45px;
        flex-shrink: 0;
        background: #FEB300;
        left: 0;
        top: 0;
    }
</style>
