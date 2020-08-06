@extends('admin.home')

@section('module-content')
<!-- Main content -->
<section class="main-panel">
    <div class="row">
        <div class="card" style="width: 100%">
            <div class="card-header">Site Management</div> 
            
            @if (session('status-success'))
            <div class="card-body">
                <div class="alert alert-success text-left">
                    {{ session('status-success') }}
                </div>
            </div>
            @endif
            
            @if (session('status-failed'))
            <div class="card-body">
                <div class="alert alert-danger text-left">
                    {{ session('status-failed') }}
                </div>
            </div>
            @endif
            
            @if (count($errors) > 0)
            <div class="card-body">
                <div class="alert alert-danger text-left">
                    <strong>Whoops!</strong> There were problems with the input: <br />
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif
            
            <div class="card-body">
                <form autocomplete="off" id="settingsform" action="{{ route('settings.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="col-sm-12">
                                <div  class="form-group row">
                                    <h4>Website Profile</h4>
                                </div>
                                <div class="form-row">
                                    <div  class="custom-control form-group  col-sm-12">
                                        <label class="@error('domain_name') text-danger @enderror" for="domain_name">Domain name *</label>
                                        <input maxlength="191" type="text" class="form-control ae-input-field @error('domain_name') is-invalid @enderror " name="domain_name" value="{{ old('domain_name', $data['model']['domain_name']) }}" id="domain_name" placeholder="ex. your.website.com" required/>
                                        @error('domain_name') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('website_name') text-danger @enderror" for="website_name">Website name *</label>
                                        <input maxlength="191" type="text" class="form-control ae-input-field @error('website_name') is-invalid @enderror " name="website_name" value="{{ old('website_name', $data['model']['website_name']) }}" id="website_name" placeholder="ex. Your Website" required/>
                                        @error('website_name') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('owner') text-danger @enderror" for="owner">Owner</label>
                                        <input maxlength="191" type="text" class="form-control ae-input-field @error('owner') is-invalid @enderror " name="owner" value="{{ old('owner', $data['model']['owner']) }}" id="owner" placeholder="Owner's name" />
                                        @error('owner') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                                <div  class="form-group row mt-3">
                                    <h4>For SEO purposes</h4>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('meta_title') text-danger @enderror" for="meta_title">Default Page Title *</label>
                                        <input maxlength="191" type="text" class="form-control ae-input-field @error('meta_title') is-invalid @enderror " name="meta_title" value="{{ old('meta_title', $data['model']['meta_title']) }}" id="meta_title" placeholder="Default page title" required/>
                                        @error('meta_title') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('meta_keywords') text-danger @enderror" for="meta_keywords">Keywords/Tags</label>
                                        <input type="text" class="form-control ae-input-field @error('meta_keywords') is-invalid @enderror " name="meta_keywords" value="{{ old('meta_keywords', $data['model']['meta_keywords']) }}" id="meta_keywords" placeholder="Default page keywords" />
                                        @error('meta_keywords') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('meta_description') text-danger @enderror" for="meta_description">Page Description *</label>
                                        <textarea  class="form-control ae-input-field @error('meta_description') is-invalid @enderror " name="meta_description" id="meta_description" placeholder="Default page description" rows="5" required>{{ old('meta_description', $data['model']['meta_description']) }}</textarea>
                                        @error('meta_description') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="col-sm-12">

                                <div  class="form-group row">
                                    <h4>Email Settings</h4>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('email_recipients') text-danger @enderror" for="email_recipients">Recipients</label>
                                        <input type="text" class="form-control ae-input-field @error('email_recipients') is-invalid @enderror " name="email_recipients" value="{{ old('email_recipients', $data['model']['email_recipients']) }}" id="email_recipients" placeholder="Recipient" />
                                        @error('email_recipients') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('email_cc') text-danger @enderror" for="email_cc">CCs</label>
                                        <input type="text" class="form-control ae-input-field @error('email_cc') is-invalid @enderror " name="email_cc" value="{{ old('email_cc', $data['model']['email_cc']) }}" id="email_cc" placeholder="Cc" />
                                        @error('email_cc') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('email_bcc') text-danger @enderror" for="email_bcc">BCCs</label>
                                        <input type="text" class="form-control ae-input-field @error('email_bcc') is-invalid @enderror " name="email_bcc" value="{{ old('email_bcc', $data['model']['email_bcc']) }}" id="email_bcc" placeholder="Bcc" />
                                        @error('email_bcc') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                                <div  class="form-group row mt-3">
                                    <h4>Server Settings</h4>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('developer') text-danger @enderror" for="developer">Developer</label>
                                        <input maxlength="191" type="text" class="form-control ae-input-field @error('developer') is-invalid @enderror " name="developer" value="{{ old('developer', $data['model']['developer']) }}" id="developer" placeholder="Developer's name" />
                                        @error('developer') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div  class="form-group  col-sm-12">
                                        <label class="@error('timezone') text-danger @enderror" for="timezone">Timezone *</label>
                                        {{old('timezone')}}
                                        <treeselect-form 
                                            v-bind:value="{{ (Session::getOldInput('timezone')) ? json_encode(Session::getOldInput('timezone')): json_encode($data['model']['timezone']) }}"
                                            v-bind:selectoptions="{{ json_encode($data['timezones']) }}"
                                            v-bind:haserror="{{ $errors->has('timezone') ? "true": "false" }}"
                                            v-bind:fieldname="{{ json_encode('timezone') }}"
                                            v-bind:multiple="{{ json_encode(false) }}"
                                            v-bind:forpagetemplate="{{ json_encode(false) }}"
                                            v-bind:forpagetemplateurl="{{ json_encode(null) }}">
                                        </treeselect-form>
                                        @error('timezone') <div class="invalid-feedback">{{ $message }}</div> @enderror 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <input  type="submit" class="btn btn-primary" value="Submit" />
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection