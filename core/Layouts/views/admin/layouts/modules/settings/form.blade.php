@extends('admin.home')

@section('module-content')
<!-- Main content -->
<section class="col-md-9 main-panel">
    <div class="row">
        <div class="col-md-12">
            <form autocomplete="off" v-on:submit.prevent="onSubmit" id="settingsform">
                <settings-form 
                    v-bind:info='{{ json_encode($data['model']) }}'
                    v-bind:timezones='{{ json_encode($data['timezones']) }}'
                    v-bind:tags='{{ json_encode($data['tags']) }}'>
                </settings-form>
            </form>
        </div>
    </div>
</section>
@endsection