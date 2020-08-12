@extends('admin.home')

@section('module-content')
<section class="main-panel">
    <div class="card">
        <div class="card-header">Dashboard</div>

        <div class="card-body">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif

            <div class="row">
                <div class="col-sm-7">
                    <h4>Change Logs</h4>
                    <table id="changelogs" class="table table-striped table-bordered small">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th class="text-nowrap">First Name</th>
                                <th class="text-nowrap">Last Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th class="text-nowrap">Date Updated</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="col-sm-5">
                    <h4>User Logs</h4>
                    <table id="userlogs" class="table table-striped table-bordered small">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<link href="{{ asset('DataTables-Bootstrap/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('javascript')
<script src="{{ asset('DataTables-Bootstrap/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        
        $('#userlogs').DataTable({
            processing: true,
            "ajax": "{{ route('admin.users.log.data') }}",
            "columns": [
                {"data": "email"},
                {"data": "log_in"},
                {"data": "log_out"}
            ]
        });
    });
</script>
@endsection