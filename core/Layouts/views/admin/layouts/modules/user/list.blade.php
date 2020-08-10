@extends('admin.home')

@section('module-content')
<!-- Main content -->
<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Users Management
                @can('users-create')
                <a href="{{ route('admin.users.create') }}" class="float-right">Create New User</a>
                @endcan
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
<link href="{{ asset('DataTables-Bootstrap/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('javascript')
<script src="{{ asset('DataTables-Bootstrap/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('#userlists').DataTable({
            responsive: true,
            processing: true,
            "ajax": "{{ route('admin.users.data') }}",
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
                        var straction = "";
                        @can('users-edit')
                            straction += "<a href='{{ route('admin.users.index') }}/" + full.id + "/edit'>Edit</a> | ";
                        @endcan
                        @can('users-list')
                            straction +=  "<a href='{{ route('admin.users.index') }}/" + full.id + "'>View Details</a>";
                        @endcan
                        @can('users-delete')
                            straction += ' | <a href="#" onclick="showdeletemodal(' + full.id + ',\'' + full.email + '\', \'{{ route("admin.users.index") }}\/' + full.id + '\')" class="text-danger">Delete</a>';
                        @endcan
                        return straction;
                    }
                }
            ],
            // to fix error in responsive: true option
            "columnDefs": [{
                "defaultContent": "-",
                "targets": "_all"
            }]
        });
    });
</script>
@endsection