@extends('admin.home')


@section('module-content')

<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Module Management
                @can('modules-create')
                <a href="{{ route('modules.create') }}" class="float-right"> Create New Module</a>
                @endcan
            </div>
            
            <div class="card-body">
                @if (session('status-success'))
                <div class="alert alert-success text-left">
                    {{ session('status-success') }}
                </div>
                @endif
            
                <table id="moduleslists" class="table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Name</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>


@endsection

@section('styles')
<link href="{{ asset('DataTables-Bootstrap4/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('javascript')
<script src="{{ asset('DataTables-Bootstrap4/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        
        $('#moduleslists').DataTable();
    });
</script>
@endsection