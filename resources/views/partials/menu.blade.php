<div id="sidebar" class="c-sidebar c-sidebar-fixed c-sidebar-lg-show">

    <div class="c-sidebar-brand d-md-down-none">
        <a class="c-sidebar-brand-full h4" href="#">
            {{ trans('panel.site_title') }}
        </a>
    </div>

    <ul class="c-sidebar-nav">
        <li class="c-sidebar-nav-item">
            <a href="{{ route("admin.home") }}" class="c-sidebar-nav-link">
                <i class="c-sidebar-nav-icon fas fa-fw fa-tachometer-alt">

                </i>
                {{ trans('global.dashboard') }}
            </a>
        </li>
        @can('user_management_access')
            <li class="c-sidebar-nav-dropdown">
                <a class="c-sidebar-nav-dropdown-toggle" href="#">
                    <i class="fa-fw fas fa-users c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userManagement.title') }}
                </a>
                <ul class="c-sidebar-nav-dropdown-items">
                    @can('permission_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.permissions.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-unlock-alt c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.permission.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.roles.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-briefcase c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.role.title') }}
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li class="c-sidebar-nav-item">
                            <a href="{{ route("admin.users.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                                <i class="fa-fw fas fa-user c-sidebar-nav-icon">

                                </i>
                                {{ trans('cruds.user.title') }}
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
        @can('scan_queue_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.scan-queues.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/scan-queues') || request()->is('admin/scan-queues/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-chess-queen c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.scanQueue.title') }}
                </a>
            </li>
        @endcan
        @can('scan_proxy_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.scan-proxies.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/scan-proxies') || request()->is('admin/scan-proxies/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-laptop c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.scanProxy.title') }}
                </a>
            </li>
        @endcan
        @can('user_data_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.user-datas.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/user-datas') || request()->is('admin/user-datas/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-address-book c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.userData.title') }}
                </a>
            </li>
        @endcan
        @can('scan_data_cellular_access')
            <li class="c-sidebar-nav-item">
                <a href="{{ route("admin.scan-data-cellulars.index") }}" class="c-sidebar-nav-link {{ request()->is('admin/scan-data-cellulars') || request()->is('admin/scan-data-cellulars/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-database c-sidebar-nav-icon">

                    </i>
                    {{ trans('cruds.scanDataCellular.title') }}
                </a>
            </li>
        @endcan
        @if(file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php')))
            @can('profile_password_edit')
                <li class="c-sidebar-nav-item">
                    <a class="c-sidebar-nav-link {{ request()->is('profile/password') || request()->is('profile/password/*') ? 'active' : '' }}" href="{{ route('profile.password.edit') }}">
                        <i class="fa-fw fas fa-key c-sidebar-nav-icon">
                        </i>
                        {{ trans('global.change_password') }}
                    </a>
                </li>
            @endcan
        @endif
        <li class="c-sidebar-nav-item">
            <a href="#" class="c-sidebar-nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                <i class="c-sidebar-nav-icon fas fa-fw fa-sign-out-alt">

                </i>
                {{ trans('global.logout') }}
            </a>
        </li>
    </ul>

</div>