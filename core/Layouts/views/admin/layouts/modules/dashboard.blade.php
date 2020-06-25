@extends('admin.home')

@section('module-content')
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
@endsection