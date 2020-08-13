@extends('admin.app')


@section('module-content')
<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">
                Edit Navigation Setting
                @can('menus-list')
                <a href="{{ route('admin.menus.index') }}" class="float-right">Back</a>
                @endcan
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
                
                {!! Form::model($settings, ['method' => 'POST','route' => ['admin.menus.settings.store', $settings->menu_id]]) !!}
                {!! Form::hidden('menu_id') !!}
                <div class="row">
                    <div class="col-sm-12 col-md-12 col-lg-8">
                        <div class="col-sm-12">
                            <div class="form-row">
                                <div  class="form-group  col-sm-4">
                                    <label class="@error('main_ul_class') text-danger @enderror" for="main_ul_class"><code><</code>ul<code>></code> class *</label>
                                    <input maxlength="50" type="text" class="form-control ae-input-field @error('main_ul_class') is-invalid @enderror " name="main_ul_class" value="{{ old('main_ul_class', $settings->main_ul_class) }}" id="main_ul_class" required/>
                                    @error('main_ul_class') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                                <div  class="form-group  col-sm-4">
                                    <label class="@error('main_li_class') text-danger @enderror" for="main_li_class"><code><</code>li<code>></code> class *</label>
                                    <input maxlength="50" type="text" class="form-control ae-input-field @error('main_li_class') is-invalid @enderror " name="main_li_class" value="{{ old('main_li_class', $settings->main_li_class) }}" id="main_li_class" required/>
                                    @error('main_li_class') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                                <div  class="form-group  col-sm-4">
                                    <label class="@error('main_anch_class') text-danger @enderror" for="main_anch_class"><code><</code>a<code>></code> class *</label>
                                    <input maxlength="50" type="text" class="form-control ae-input-field @error('main_anch_class') is-invalid @enderror " name="main_anch_class" value="{{ old('main_anch_class', $settings->main_anch_class) }}" id="main_anch_class" required/>
                                    @error('main_anch_class') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                            </div>
                            <div class="form-row">
                                <div  class="form-group  col-sm-4">
                                    <label class="@error('suc_strt_div') text-danger @enderror" for="suc_strt_div">Succeeding <code>main</code> block</label>
                                    <input maxlength="50" type="text" class="form-control ae-input-field @error('suc_strt_div') is-invalid @enderror " name="suc_strt_div" value="{{ old('suc_strt_div', $settings->suc_strt_div) }}" id="suc_strt_div"/>
                                    @error('suc_strt_div') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                                <div  class="form-group  col-sm-4">
                                    <label class="@error('suc_end_div') text-danger @enderror" for="suc_end_div">End <code>main</code> block</label>
                                    <input maxlength="50" type="text" class="form-control ae-input-field @error('suc_end_div') is-invalid @enderror " name="suc_end_div" value="{{ old('suc_end_div', $settings->suc_end_div) }}" id="suc_end_div"/>
                                    @error('suc_end_div') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                            </div>
                            <div class="form-row">
                                <div  class="form-group  col-sm-4">
                                    <label class="@error('suc_strt_list') text-danger @enderror" for="suc_strt_list">Succeeding <code>list</code> block</label>
                                    <input maxlength="50" type="text" class="form-control ae-input-field @error('suc_strt_list') is-invalid @enderror " name="suc_strt_list" value="{{ old('suc_strt_list', $settings->suc_strt_list) }}" id="suc_strt_list"/>
                                    @error('suc_strt_list') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                                <div  class="form-group  col-sm-4">
                                    <label class="@error('suc_end_list') text-danger @enderror" for="suc_end_list">End <code>list</code> block</label>
                                    <input maxlength="50" type="text" class="form-control ae-input-field @error('suc_end_list') is-invalid @enderror " name="suc_end_list" value="{{ old('suc_end_list', $settings->suc_end_list) }}" id="suc_end_list"/>
                                    @error('suc_end_list') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                            </div>
                            <div class="form-row">
                                <div  class="form-group  col-sm-4">
                                    <label class="@error('suc_anch_class') text-danger @enderror" for="suc_anch_class">Succeeding <code><</code>a<code>></code> class *</label>
                                    <input maxlength="50" type="text" class="form-control ae-input-field @error('suc_anch_class') is-invalid @enderror " name="suc_anch_class" value="{{ old('suc_anch_class', $settings->suc_anch_class) }}" id="suc_anch_class"/>
                                    @error('suc_anch_class') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        @can('menus-edit')
                        <button type="submit" class="btn btn-primary">Submit</button>
                        @endcan
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection