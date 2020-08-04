@extends('admin.home')


@section('module-content')

<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Page Management
                @can('pages-create')
                <a href="{{ route('pages.create') }}" class="float-right"> Create New Page</a>
                @endcan
            </div>
            
            <div class="card-body">
                @if (session('status-success'))
                <div class="alert alert-success text-left">
                    {{ session('status-success') }}
                </div>
                @endif
            
                <table id="pageslists" class="table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Url</th>
                            <th>Description</th>
                            <th>Javascripts</th>
                            <th>CSS</th>
                            <th>Template</th>
                            <th class="text-nowrap">Date Updated</th>
                            <th width="15%">Action</th>
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
        var pagedtable = $('#pageslists').DataTable({
            processing: true,
            "ajax": "{{ route('pages.data') }}",
            "columns": [
                {"data": "id"},
                {"data": "title"},
                {"data": "url"},
                {"data": "description"},
                {"data": "javascripts"},
                {"data": "css"},
                {"data": "template"},
                {"data": "updated_at"},
                {
                    width: "5%",
                    bSearchable: false,
                    bSortable: false,
                    mRender: function (data, type, full) {
                        return "<a href='{{ route('pages.index') }}/" + full.id + "/edit'>Edit</a> | "
                                + '<a href="#" onclick="showdeletemodal(' + full.id + ',\'' + full.title + '\', \'{{ route("pages.index") }}\/' + full.id + '\')" class="text-danger">Delete</a>'
                    }
                }
            ]
        });
    });
</script>
@endsection