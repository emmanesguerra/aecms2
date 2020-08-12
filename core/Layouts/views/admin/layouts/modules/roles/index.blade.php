@extends('admin.home')


@section('module-content')

<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Role Management
                @can('roles-create')
                <a href="{{ route('admin.roles.create') }}" class="float-right"> Create New Role</a>
                @endcan
            </div>
            
            <div class="card-body">
                @if (session('status-success'))
                <div class="alert alert-success text-left">
                    {{ session('status-success') }}
                </div>
                @endif
            
                <table id="rolelists" class="datatable table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Name</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th width="5%">ID</th>
                            <th width="15%">Name</th>
                            <th width="5%"></th>
                        </tr>
                    </tfoot>
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
        $('#rolelists').DataTable({
            "ajax": "{{ route('admin.roles.data') }}",
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {
                    width: "5%",
                    bSearchable: false,
                    bSortable: false,
                    mRender: function (data, type, full) {
                        var straction = "";
                        @can('roles-edit')
                            straction += "<a href='{{ route('admin.roles.index') }}/" + full.id + "/edit'>Edit</a> | ";
                        @endcan
                        @can('roles-list')
                            straction +=  "<a href='{{ route('admin.roles.index') }}/" + full.id + "'>View Details</a>";
                        @endcan
                        @can('roles-delete')
                            straction += ' | <a href="#" onclick="showdeletemodal(' + full.id + ',\'' + full.name + '\', \'{{ route("admin.roles.index") }}\/' + full.id + '\')" class="text-danger">Delete</a>';
                        @endcan
                        return straction;
                    }
                }
            ]
        });
    });
</script>
@endsection