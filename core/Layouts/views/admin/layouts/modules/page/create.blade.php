@extends('admin.home')


@section('module-content')
<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Create New Pages
                <a href="{{ route('pages.index') }}" class="float-right">Back</a>
            </div> 
            
            <div class="card-body">
            
                @if (session('status-failed'))
                <div class="alert alert-danger text-left">
                    {{ session('status-failed') }}
                </div>
                @endif

                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif
                
                {!! Form::open(array('route' => 'pages.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-10">
                        <div class="col-sm-12">
                            <div class="form-row">
                                <div  class="form-group  col-sm-5">
                                    <label class="@error('title') text-danger @enderror" for="title">Title *</label>
                                    <input type="text" class="form-control ae-input-field @error('title') is-invalid @enderror " name="title" value="{{ old('title') }}" id="title" placeholder="Title">
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                                <div  class="form-group  col-sm-5">
                                    <label class="@error('url') text-danger @enderror" for="url">Url *</label>
                                    <input type="text" class="form-control ae-input-field @error('url') is-invalid @enderror " name="url" value="{{ old('url') }}" id="url" placeholder="Url">
                                    @error('url') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                            </div>
                            <div class="form-row">
                                <div  class="form-group  col-sm-10">
                                    <label class="@error('description') text-danger @enderror" for="description">Description</label>
                                    <input type="text" class="form-control ae-input-field @error('description') is-invalid @enderror " name="description" value="{{ old('description') }}" id="description" placeholder="Description">
                                    @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                            </div>
                            <div class="form-row">
                                <div  class="form-group  col-sm-5">
                                    <label class="@error('javascripts') text-danger @enderror" for="javascripts">Javascripts</label>
                                    {{old('javascripts')}}
                                    <treeselect-form 
                                        v-bind:value="{{ (Session::getOldInput('javascripts')) ? json_encode(Session::getOldInput('javascripts')): json_encode(null) }}"
                                        v-bind:selectoptions="{{ json_encode($scripts) }}"
                                        v-bind:haserror="{{ $errors->has('javascripts') ? "true": "false" }}"
                                        v-bind:fieldname="{{ json_encode('javascripts') }}">
                                    </treeselect-form>
                                    @error('javascripts') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                                <div  class="form-group  col-sm-5">
                                    <label class="@error('css') text-danger @enderror" for="css">Styles</label>
                                    {{old('css')}}
                                    <treeselect-form 
                                        v-bind:value="{{ (Session::getOldInput('css')) ? json_encode(Session::getOldInput('css')): json_encode(null) }}"
                                        v-bind:selectoptions="{{ json_encode($styles) }}"
                                        v-bind:haserror="{{ $errors->has('css') ? "true": "false" }}"
                                        v-bind:fieldname="{{ json_encode('css') }}">
                                    </treeselect-form>
                                    @error('css') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                            </div>
                            <div class="form-row">
                                <div  class="form-group  col-sm-5">
                                    <label class="@error('template') text-danger @enderror" for="template">Html Template *</label>
                                    {{old('template')}}
                                    <treeselect-form 
                                        v-bind:value="{{ (Session::getOldInput('template')) ? json_encode(Session::getOldInput('template')): json_encode(null) }}"
                                        v-bind:selectoptions="{{ json_encode($files) }}"
                                        v-bind:haserror="{{ $errors->has('template') ? "true": "false" }}"
                                        v-bind:fieldname="{{ json_encode('template') }}">
                                    </treeselect-form>
                                    @error('template') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection