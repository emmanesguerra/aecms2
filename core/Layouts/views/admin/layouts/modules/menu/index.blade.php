@extends('admin.home')


@section('module-content')

<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Menus Management
                @can('modules-create')
                <span id="addnew" class="float-right text-primary" style="cursor: pointer"> Create Menu</span>
                @endcan
            </div>
            
            <div class="card-body">
                @if (session('status-success'))
                <div class="alert alert-success text-left">
                    {{ session('status-success') }}
                </div>
                @endif
            
                <table id="menulists" class="table table-striped table-bordered small">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th width="20%">Action</th>
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
        var menudtable = $('#menulists').DataTable({
            processing: true,
            "ajax": "{{ route('menus.data') }}",
            "columns": [
                {"data": "title"},
                {
                    width: "20%",
                    bSearchable: false,
                    bSortable: false,
                    mRender: function (data, type, full) {
                        return "<a href='{{ route('modules.index') }}/" + full.id + "/edit'>Edit</a> | "
                                + "<a href='{{ route('modules.index') }}/" + full.id + "'>View Details</a>"
                    }
                }
            ]
        });
        
        var counter = 1;
        var iscreating = false;
        $('#addnew').on( 'click', function () {
            if(!iscreating) {
                menudtable.row.add([
                    '   <div class="form-row">\n\
                            <input id="ntitle-'+counter+'" type="text" class="form-control form-control-sm" placeholder="Menu Title" /> \n\
                            <div id="error-'+counter+'" class="col-sm-12 text-danger my-1"></div>\n\
                        </div>',
                    '<button onclick="saveRow('+counter+', 0)" type="button" class="btn btn-sm btn-primary">Save</button>\n\
                     <button onclick="removeRow()" type="button" class="btn btn-sm btn-default">Cancel</button>']).draw( false );

                counter++;
                iscreating = true;
            }
        });
    
        removeRow = function () {
            menudtable.row().remove().draw(false);
            iscreating = false;
        }
    
        saveRow = function (counterid, parentid) {
            axios.post("{{ route('menus.store') }}", {
                nTitle: $('#ntitle-'+counterid).val(),
                parentId: parentid
            }).then(function (response) {
                console.log(response);
            }).catch(function (error) {
                console.log(error.response)
                $('#error-'+counterid).html(error.response.data.errors.nTitle[0]);
            });
        }
    });
</script>
@endsection