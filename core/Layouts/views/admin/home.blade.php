@extends('layouts.app')

@section('content')
<div class="container">
    
    @include('admin.layouts.common.leftsidebar')

    @yield('module-content')
            
</div>

@endsection
