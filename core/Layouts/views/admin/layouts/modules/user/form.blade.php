@extends('admin.home')

@section('module-content')
<!-- Main content -->
<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">Settings</div> 

            <div class="card-body">
                <form autocomplete="off" v-on:submit.prevent="onSubmit" id="usersform">
                    <users-form 
                        v-bind:info='{{ json_encode($data['model']) }}'
                        v-bind:userindexurl="'{{ route('user.index') }}'">
                    </users-form>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection