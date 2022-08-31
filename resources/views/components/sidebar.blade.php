<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">

            <li>
                <a href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>

            @can('retrieve-my-contacts')
                <li class="{{ request()->is('my/contact*') ? 'active' : '' }}">
                    <a href="{{ route('my-contact.index') }}" aria-expanded="false"
                        class="{{ request()->is('my/contact*') ? 'active' : '' }}">
                        <i class="fa fa-vcard-o"></i><span class="nav-text">My Contacts</span>
                    </a>
                </li>
            @endcan

            @can('retrieve-my-devices')
            <li class="{{ request()->is('my/device*') ? 'active' : '' }}">
                <a href="{{ route('my-device.index') }}" aria-expanded="false"
                    class="{{ request()->is('my/device*') ? 'active' : '' }}">
                    <i class="fa fa-share-alt"></i><span class="nav-text">My Devices</span>
                </a>
            </li>
        @endcan
            
            @can('retrieve-master-data')
            <li class="{{ request()->is('user*') || request()->is('contact*') || request()->is('device*') || request()->is('device-log*') ? 'active' : '' }}">
                <a class="has-arrow" href="javascript:void()" aria-expanded="{{ request()->is('user*') || request()->is('contact*') || request()->is('device*') || request()->is('device-log*') ? 'true' : 'false' }}">
                    <i class="icon-grid menu-icon"></i><span class="nav-text">Master Data</span>
                </a>
                <ul aria-expanded="false" class="collapse {{ request()->is('user*') || request()->is('contact*') || request()->is('device*') || request()->is('device-log*') ? 'in' : '' }}" style="">
                    @can('retrieve-users')
                        <li class="{{ request()->is('user*') ? 'active' : '' }}">
                            <a href="{{ route('user.index') }}" aria-expanded="false"
                                class="{{ request()->is('user*') ? 'active' : '' }}">
                                <i class="fa fa-users"></i><span class="nav-text">User</span>
                            </a>
                        </li>
                    @endcan

                    @can('retrieve-contacts')
                        <li class="{{ request()->is('contact*') ? 'active' : '' }}">
                            <a href="{{ route('contact.index') }}" aria-expanded="false"
                                class="{{ request()->is('contact*') ? 'active' : '' }}">
                                <i class="fa fa-vcard-o"></i><span class="nav-text">Contact</span>
                            </a>
                        </li>
                    @endcan

                    @can('retrieve-devices')
                        <li class="{{ request()->is('device*') ? 'active' : '' }}">
                            <a href="{{ route('device.index') }}" aria-expanded="false"
                                class="{{ request()->is('device*') ? 'active' : '' }}">
                                <i class="fa fa-share-alt"></i><span class="nav-text">Device</span>
                            </a>
                        </li>
                    @endcan

                    @can('retrieve-device-logs')
                        <li class="{{ request()->is('device-log*') ? 'active' : '' }}">
                            <a href="{{ route('device-log.index') }}" aria-expanded="false"
                                class="{{ request()->is('device-log*') ? 'active' : '' }}">
                                <i class="fa fa-tasks"></i><span class="nav-text">Device Log</span>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
            @endcan
        </ul>
    </div>
</div>
