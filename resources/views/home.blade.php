@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3 left-panel">
            <div class="card mb-4">
                <div class="card-header">Ae Menu</div>

                <div class="card-body">
                    <ul class="admin-menu">
                        <li><a href="/"><i class="fa fa-gears"></i> <span>Settings</span></a></li>
                        <li><a href="/"><i class="fa fa-user-o"></i> <span>Users</span></a></li>
                        <li><a href="/"><i class="fa fa-unlock-alt"></i> <span>User Permissions</span></a></li>
                        <li><a href="/"><i class="fa fa-cube"></i> <span>Modules</span></a></li>
                        <li><a href="/"><i class="fa fa-file-o"></i> <span>Pages</span></a></li>
                        <li><a href="/"><i class="fa fa-bars"></i> <span>Navigations</span></a></li>
                    </ul>
                </div>
            </div>
            
            <div class="card">
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
        </div>
        
        <div class="col-md-9 main-panel">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
