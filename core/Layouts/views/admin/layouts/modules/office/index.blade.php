@extends('admin.home')


@section('module-content')

<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Office Location Management
                @can('offices-create')
                <a href="{{ route('admin.offices.create') }}" class="float-right"> Create New Office Location</a>
                @endcan
            </div>
            
            <div class="card-body">
                @if (session('status-success'))
                <div class="alert alert-success text-left">
                    {{ session('status-success') }}
                </div>
                @endif
            
                <table id="contentslists" class="table table-striped table-bordered small">
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
        
        $('#contentslists').DataTable({
            responsive: true,
            processing: true,
            "ajax": "{{ route('admin.offices.data') }}",
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