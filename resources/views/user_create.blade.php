@extends('layouts.home_layout')

@section('section_stylesheet')
    @parent
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/select2/dist/css/select2.min.css') }}" />
@endsection

@section('section_script_main')
    @parent
@endsection

@section('content')
<!-- row -->
<div class="row">
    
    <!-- col -->
    <div class="col-sm-12">
        <!-- form -->
        <form action="{{ url('config/user/create') }}" method="POST" class="col-sm-6" autocomplete="off">
            @csrf
            <!-- form-group -->
            <div class="form-group col-sm-12">
                <label for="name" class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}" required/>
                </div>
                <!-- span id="form-control" class="help-block"></span -->
            </div>
            <!-- .form-group -->
            
            <!-- form-group -->
            <div class="form-group col-sm-12">
                <label for="email" class="col-sm-2 control-label">E-mail</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}" required/>
                </div>
                <!-- span id="form-control" class="help-block"></span -->
            </div>
            <!-- .form-group -->
            
            <!-- form-group -->
            <div class="form-group col-sm-12">
                <label for="epf_no" class="col-sm-2 control-label">EPF-NO</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <input type="text" class="form-control" id="epf_no" name="epf_no" placeholder="EPF-NO" value="{{ old('epf_no') }}"/>
                </div>
                <!-- span id="form-control" class="help-block"></span -->
            </div>
            <!-- .form-group -->
            
            <!-- form-group -->
            <div class="form-group col-sm-12">
                <label for="phone" class="col-sm-2 control-label">Phone</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}"/>
                </div>
                <!-- span id="form-control" class="help-block"></span -->
            </div>
            <!-- .form-group -->
            
            <!-- form-group -->
            <div class="form-group col-sm-12">
                <label for="user_position" class="col-sm-2 control-label">Position</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <input type="text" class="form-control" id="user_position" name="user_position" placeholder="Position" value="{{ old('user_position') }}"/>
                </div>
                <!-- span id="form-control" class="help-block"></span -->
            </div>
            <!-- .form-group -->
            
            <!-- form-group -->
            <div class="form-group col-sm-12">
                <label for="department" class="col-sm-2 control-label">Department</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <input type="text" class="form-control" id="department" name="department" placeholder="Department" value="{{ old('department') }}"/>
                </div>
                <!-- span id="form-control" class="help-block"></span -->
            </div>
            <!-- .form-group -->
            
            <!-- form-group -->
            <div class="form-group col-sm-12">
                <label for="password" class="col-sm-2 control-label">Password</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="{{ old('password') }}"/>
                </div>
                <!-- span id="form-control" class="help-block"></span -->
            </div>
            <!-- .form-group -->
            
            <!-- form-group -->
            <div class="form-group col-sm-12">
                <!-- btn-toolbar -->
                <div class="col col-sm-12">
                    <!-- div class="btn-group btn-group-lg pull-right" -->
                        <button type="submit" class="btn btn-primary pull-right">Submit</button>
                    <!-- /div -->
                </div>
            </div>
            <!-- /.form-group -->
            
        </form>
        <!-- /.form -->
    </div>
    <!-- /.col >
    
</div>
<!-- /.row -->
@endsection

@section('section_script')
    @parent
    <script src="{{ asset('node_modules/admin-lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    @includeIf('partials.select_user_position')
@endsection