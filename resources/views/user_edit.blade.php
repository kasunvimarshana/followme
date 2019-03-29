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
        
        <!-- accordion -->
        <div class="panel-group" id="accordion">
            
            <!-- panel -->
            <div id="collapseOneParent" class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> Edit User</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <!-- --- -->
                        <!-- row -->
                        <div class="row">

                            <!-- col -->
                            <div class="col-sm-12">
                                <!-- form -->
                                <form action="{!! route('user.update', ['user' => $user->id]) !!}" method="POST" class="col-sm-8" autocomplete="off" id="userEditForm">
                                    @csrf
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $user->name }}"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="email" class="col-sm-2 control-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ $user->email }}"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="epf_no" class="col-sm-2 control-label">EPF-NO</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="text" class="form-control" id="epf_no" name="epf_no" placeholder="EPF-NO" value="{{ $user->epf_no }}"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="phone" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ $user->phone }}"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="user_position_id" class="col-sm-2 control-label">Position</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <select class="form-control select2" id="user_position_id" name="user_position_id" value="{{ $user->user_position_id }}" data-placeholder="Position" style="width: 100%;">
                                                @if($user)
                                                    @php
                                                        $oldUserPosition = $user->userPosition;
                                                    @endphp
                                                    @isset($oldUserPosition)
                                                        <option value="{{ $oldUserPosition->id }}" selected> {{ $oldUserPosition->name }} </option>
                                                    @endisset
                                                @endif
                                            </select>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="department_id" class="col-sm-2 control-label">Department</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <select class="form-control select2" id="department_id" name="department_id" value="{{ $user->department_id }}" data-placeholder="Department" style="width: 100%;">
                                                @if($user)
                                                    @php
                                                        $oldDepartment = $user->department;
                                                    @endphp
                                                    @isset($oldDepartment)
                                                        <option value="{{ $oldDepartment->id }}" selected> {{ $oldDepartment->name }} </option>
                                                    @endisset
                                                @endif
                                            </select>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <!-- btn-toolbar -->
                                        <div class="col col-sm-12">
                                            <!-- div class="btn-group btn-group-lg pull-right" -->
                                                <button type="submit" class="btn btn-primary pull-right">Edit</button>
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
                        <!-- --- -->
                    </div>
                </div>
            </div>
            <!-- /.panel -->
            <!-- panel -->
            <div id="collapseTwoParent" class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-plus"></span> Reset Password</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse">
                    <div class="panel-body">
                        
                        <!-- --- -->
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-sm-12">
                                <!-- form -->
                                <form action="{!! route('user.resetPassword', ['user' => $user->id]) !!}" method="POST" class="col-sm-8" autocomplete="off" id="userPasswordResetForm">
                                    @csrf
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="password_old" class="col-sm-2 control-label">Old</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="password" class="form-control" id="password_old" name="password_old" placeholder="Old Password" value="" required/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="password_new" class="col-sm-2 control-label">New</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="password" class="form-control" id="password_new" name="password_new" placeholder="New Password" value=""/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <!-- btn-toolbar -->
                                        <div class="col col-sm-12">
                                            <!-- div class="btn-group btn-group-lg pull-right" -->
                                                <button type="submit" class="btn btn-primary pull-right">Reset</button>
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
                        <!-- --- -->
                        
                    </div>
                </div>
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.accordion -->
        
    </div>
    <!-- /.col -->
    
</div>
<!-- /.row -->
@endsection

@section('section_script')
    @parent
    <!-- Select2 -->
    <script src="{{ asset('node_modules/admin-lte/bower_components/select2/dist/js/select2.full.min.js') }}"></script>

    @includeIf('partials.user_position_select')
    @includeIf('partials.department_select')
@endsection