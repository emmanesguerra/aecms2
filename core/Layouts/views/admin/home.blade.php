@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            
        @include('admin.layouts.common.leftsidebar')
        
        @yield('module-content')
    </div>
</div>

@endsection
