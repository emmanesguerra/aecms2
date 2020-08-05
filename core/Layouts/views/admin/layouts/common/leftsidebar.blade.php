<section class="left-panel">
    <div class="card mb-3">
        <div class="card-header">Ae Menu</div>

        <div class="card-body">
            <ul class="admin-menu">
                <li><a href="{{ route('settings.index') }}"><i class="fas fa-cog"></i>&nbsp;<span>Settings</span></a></li>
                <li><a href="{{ route('users.index') }}"><i class="far fa-address-book"></i>&nbsp;<span>Users</span></a></li>
                <li><a href="{{ route('roles.index') }}"><i class="fa fa-unlock-alt"></i>&nbsp;<span>Roles</span></a></li>
                <li><a href="{{ route('modules.index') }}"><i class="fas fa-atom"></i>&nbsp;<span>Modules</span></a></li>
                <li><a href="{{ route('pages.index') }}"><i class="fas fa-copy"></i>&nbsp;<span>Pages</span></a></li>
                <li><a href="{{ route('menus.index') }}"><i class="fa fa-bars"></i>&nbsp;<span>Menus</span></a></li>
            </ul>
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">User Menu</div>

        <div class="card-body">
            <ul class="admin-menu">
                <li><a href="/"><i class="fa fa-gears"></i> <span>Main Contents</span></a></li>
                <li><a href="/"><i class="fa fa-user-o"></i> <span>Panels</span></a></li>
                <li><a href="/"><i class="fa fa-unlock-alt"></i> <span>Contacts</span></a></li>
                <li><a href="/"><i class="fa fa-cube"></i> <span>Sliders</span></a></li>
                <li><a href="/"><i class="fa fa-file-o"></i> <span>Galleries</span></a></li>
                <li><a href="/"><i class="fa fa-bars"></i> <span>Testimonies</span></a></li>
            </ul>
        </div>
    </div>
</section>