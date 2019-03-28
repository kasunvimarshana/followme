@extends('layouts.home_layout')

@section('section_stylesheet')
    @parent
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" />
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
        <form action="{!! route('department.store') !!}" method="POST" class="col-sm-6" autocomplete="off">
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
            <!-- /.form-group -->
            
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
    <!-- /.col -->
    
</div>
<!-- /.row -->
@endsection

@section('section_script')
    @parent
    <!-- Select2 -->
    <script src="{{ asset('node_modules/admin-lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>
    @includeIf('partials.select_user_position')
    @includeIf('partials.select_department')
@endsection