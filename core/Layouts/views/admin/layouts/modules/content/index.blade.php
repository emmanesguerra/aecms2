@extends('admin.home')


@section('module-content')

<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Content Management
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
                            <th>Name</th>
                            <th>Type</th>
                            <th>Displayed at pages</th>
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
<link href="{{ asset('DataTables-Bootstrap4/datatables.min.css') }}" rel="stylesheet">
@endsection

@section('javascript')
<script src="{{ asset('DataTables-Bootstrap4/datatables.min.js') }}"></script>
<script>
    $(document).ready(function () {
        
        $('#contentslists').DataTable({
            responsive: true,
            processing: true,
            "ajax": "{{ route('admin.contents.data') }}",
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {"data": "type"},
                {
                    render: function (data, type, full) {
                        var page = '';
                        _.each(full.pages, function(data) {
                            page += (page == '') ? data.title: ', ' + data.title;
                        });
                        return page;
                    }
                },
                {
                    bSearchable: false,
                    bSortable: false,
                    "data": "updated_at"},
                {
                    width: "13%",
                    bSearchable: false,
                    bSortable: false,
                    mRender: function (data, type, full) {
                        var straction = "";
                        @can('modules-edit')
                            straction += "<a href='{{ route('admin.modules.index') }}/" + full.id + "/edit'>Edit</a> | ";
                        @endcan
                        @can('modules-list')
                            straction +=  "<a href='{{ route('admin.modules.index') }}/" + full.id + "'>View Details</a>";
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