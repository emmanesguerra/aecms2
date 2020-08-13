@extends('admin.app')


@section('module-content')

<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Office Location Management
                
                
                @can('offices-trash')
                <a href="{{ route('admin.offices.trashed') }}" class="float-right"> Check Trashed Records</a>
                @endcan
                @can('offices-create')
                <a href="{{ route('admin.offices.create') }}" class="float-right mr-3"> Create New Office Location</a>
                @endcan
            </div>
            
            <div class="card-body">
                
                @if (session('status-success'))
                <div class="alert alert-success text-left">
                    {{ session('status-success') }}
                </div>
                @endif
            
                <table id="officelists" class="datatable table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Address</th>
                            <th>Telephone</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Date Updated</th>
                            <th width="5%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Address</th>
                            <th>Telephone</th>
                            <th>Mobile</th>
                            <th>Email</th>
                            <th>Date Updated</th>
                            <th></th>
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
        
        $('#officelists').DataTable({
            "ajax": {
                "url": "{{ route('admin.offices.data') }}",
                "data": {
                    isTrashed: false
                }
            },
            "columns": [
                {"data": "id"},
                {"data": "address"},
                {"data": "telephone"},
                {"data": "mobile"},
                {"data": "email"},
                {"data": "updated_at"},
                {
                    width: "13%",
                    bSearchable: false,
                    bSortable: false,
                    mRender: function (data, type, full) {
                        var straction = "";
                        @can('offices-edit')
                            straction += "<a href='{{ route('admin.offices.index') }}/" + full.id + "/edit'>Edit</a> | ";
                        @endcan
                        @can('offices-list')
                            straction +=  "<a href='{{ route('admin.offices.index') }}/" + full.id + "'>View Details</a>";
                        @endcan
                        @can('offices-delete')
                            straction += ' | <a href="#" onclick="showdeletemodal(' + full.id + ',\'\', \'{{ route("admin.offices.index") }}\/' + full.id + '\')" class="text-danger">Delete</a>';
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