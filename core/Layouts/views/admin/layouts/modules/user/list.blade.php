@extends('admin.home')

@section('module-content')
<!-- Main content -->
<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Users Management
                <a href="{{ route('users.create') }}" class="float-right">Create New User</a>
            </div> 

            <div class="card-body">
            
                @if (session('status-success'))
                <div class="alert alert-success text-left">
                    {{ session('status-success') }}
                </div>
                @endif
                
                <table id="userlists" class="table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th class="text-nowrap">First Name</th>
                            <th class="text-nowrap">Last Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-nowrap">Date Updated</th>
                            <th>Action</th>
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
        $('#userlists').DataTable({
            processing: true,
            "ajax": "{{ route('users.data') }}",
            "columns": [
                {"data": "id"},
                {"data": "firstname"},
                {"data": "lastname"},
                {"data": "email"},
                {"data": "name"},
                {"data": "updated_at"},
                {
                    width: "18%",
                    bSearchable: false,
                    bSortable: false,
                    mRender: function (data, type, full) {
                        return "<a href='{{ route('users.index') }}/" + full.id + "/edit'>Edit</a> | "
                                + "<a href='{{ route('users.index') }}/" + full.id + "'>View Details</a> | "
                                + '<a href="#" onclick="showdeletemodal(' + full.id + ',\'' + full.email + '\', \'{{ route("users.index") }}\/' + full.id + '\')" class="text-danger">Delete</a>'
                    }
                }
            ]
        });
    });
</script>
@endsection