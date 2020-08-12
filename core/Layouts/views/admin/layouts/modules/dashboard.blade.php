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
                        <tfoot>
                            <tr>
                                <th>Email</th>
                                <th>Time In</th>
                                <th>Time Out</th>
                            </tr>
                        </tfoot>
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
        
        $('#userlogs tfoot th').each( function () {
            var title = $(this).text();
            $(this).html( '<input type="text" class="form-control form-control-sm" placeholder="Search '+title+'" />' );
        });
        
        userlog = $('#userlogs').DataTable({
            initComplete: function () {
                // Apply the search
                this.api().columns().every( function () {
                    var that = this;

                    $( 'input', this.footer() ).on( 'keyup change clear', function () {
                        if ( that.search() !== this.value ) {
                            that
                                .search( this.value )
                                .draw();
                        }
                    } );
                } );
            },
            sDom: 'lrtp',
            processing: true,
            "serverSide": true,
            "ajax": "{{ route('admin.users.log.data') }}",
            "columns": [
                {"data": "email"},
                {"data": "log_in"},
                {"data": "log_out"}
            ],
            "order": [[ 1, "desc" ]]
        });
    });
</script>
@endsection