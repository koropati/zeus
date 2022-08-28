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
                    <i class="icon-user menu-icon"></i><span class="nav-text">Contact</span>
                </a>
            </li>
            @endcan
        </ul>
    </div>
</div>
