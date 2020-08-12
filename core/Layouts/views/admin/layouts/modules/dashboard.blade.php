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
                <div class="col-sm-8">
                    <h4>Change Logs</h4>
                    <table id="userlists" class="table table-striped table-bordered small">
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
                <div class="col-sm-4">
                    <h4>Timesheet</h4>
                    <table id="userlists" class="table table-striped table-bordered small">
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Date Time</th>
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