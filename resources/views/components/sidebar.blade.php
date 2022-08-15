<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            
            <li>
                <a href="{{ route('dashboard') }}" aria-expanded="false">
                    <i class="icon-speedometer menu-icon"></i><span class="nav-text">Dashboard</span>
                </a>
            </li>
            
            <li class="mega-menu mega-menu-sm">
                <a class="has-arrow" href="javascript:void()" aria-expanded="false">
                    <i class="icon-globe-alt menu-icon"></i><span class="nav-text">Master Data</span>
                </a>
                <ul aria-expanded="false">
                    @can('retrieve-users')
                    <li><a href="{{ route('user.index') }}">User</a></li>
                    @endcan
                    <li><a href="javascript:;">One Column</a></li>
                    <li><a href="javascript:;">Two column</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
