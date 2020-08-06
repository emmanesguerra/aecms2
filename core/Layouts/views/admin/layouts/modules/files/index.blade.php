@extends('admin.home')


@section('module-content')

<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                File Management
                @can('menus-create')
                <a href="{{ route('admin.files.create') }}" class="float-right"> Upload File(s)</a>
                @endcan
            </div>
            
            <div class="card-body">
                @if (session('status-success'))
                <div class="alert alert-success text-left">
                    {{ session('status-success') }}
                </div>
                @endif
            
                <table id="filelists" class="table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th width='10%'>Image</th>
                            <th width='30%'>Filename</th>
                            <th width='40%'>Use these texts for your contents</th>
                            <th width='10%'>Extension</th>
                            <th width='10%'>Size</th>
                            <th width='10%'>Action</th>
                        </tr>
                    </thead>
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
        $('#filelists').DataTable();
    });
</script>
@endsection