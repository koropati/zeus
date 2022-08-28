<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            
            <li>
                <a href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>

            @can('retrieve-users')
            <li class="{{ request()->is('user*') ? 'active' : '' }}">
                <a href="{{ route('user.index') }}" aria-expanded="false" class="{{ request()->is('user*') ? 'active' : '' }}">
                    <i class="icon-user menu-icon"></i><span class="nav-text">User</span>
                </a>
            </li>
            @endcan

            @can('retrieve-contacts')
            <li class="{{ request()->is('contact*') ? 'active' : '' }}">
                <a href="{{ route('contact.index') }}" aria-expanded="false" class="{{ request()->is('contact*') ? 'active' : '' }}">
                    <i class="fa fa-envelope"></i><span class="nav-text">Contact</span>
                </a>
            </li>
            @endcan

            @can('retrieve-devices')
            <li class="{{ request()->is('device*') ? 'active' : '' }}">
                <a href="{{ route('device.index') }}" aria-expanded="false" class="{{ request()->is('device*') ? 'active' : '' }}">
                    <i class="fa fa-share-alt"></i><span class="nav-text">Device</span>
                </a>
            </li>
            @endcan

            @can('retrieve-device-logs')
            <li class="{{ request()->is('device-log*') ? 'active' : '' }}">
                <a href="{{ route('device-log.index') }}" aria-expanded="false" class="{{ request()->is('device-log*') ? 'active' : '' }}">
                    <i class="fa fa-share-alt"></i><span class="nav-text">Device Log</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</div>
