@extends('admin.home')

@section('module-content')
<!-- Main content -->
<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">Settings</div> 

            <div class="card-body">
                <form autocomplete="off" v-on:submit.prevent="onSubmit" id="settingsform">
                    <settings-form 
                        v-bind:info='{{ json_encode($data['model']) }}'
                        v-bind:settingindexurl="'{{ route('setting.index') }}'"
                        v-bind:timezones='{{ json_encode($data['timezones']) }}' >
                    </settings-form>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection