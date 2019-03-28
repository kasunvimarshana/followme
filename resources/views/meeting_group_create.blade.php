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
        <form action="{!! route('meetingGroup.store') !!}" method="POST" class="col-sm-6" autocomplete="off">
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
                <label for="department_id" class="col-sm-2 control-label">Department</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <select class="form-control select2" id="department_id" name="department_id" value="{{ old('department_id') }}" data-placeholder="Department" style="width: 100%;">
                        @if(old('department_id'))
                            @php
                                $oldDepartmentId = old('department_id');
                                $oldDepartment = \App\Department::find( $oldDepartmentId );
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
                <label for="meeting_type_id" class="col-sm-2 control-label">Meeting Type</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <select class="form-control select2" id="meeting_type_id" name="meeting_type_id" value="{{ old('meeting_type_id') }}" data-placeholder="Meeting Type" style="width: 100%;">
                        @if(old('meeting_type_id'))
                            @php
                                $oldMeetingTypeId = old('meeting_type_id');
                                $oldMeetingType = \App\MeetingType::find( $oldMeetingTypeId );
                            @endphp
                            @isset($oldMeetingType)
                                <option value="{{ $oldMeetingType->id }}" selected> {{ $oldMeetingType->name }} </option>
                            @endisset
                        @endif
                    </select>
                </div>
                <!-- span id="form-control" class="help-block"></span -->
            </div>
            <!-- /.form-group -->
            
            <!-- form-group -->
            <div class="form-group col-sm-12">
                <label for="description" class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                    <!-- p class="form-control-static"></p -->
                    <textarea class="form-control rounded-0" id="description" name="description" placeholder="Description" rows="5">{{ old('description') }}</textarea>
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
    @includeIf('partials.select_meeting_type')
    @includeIf('partials.select_department')
@endsection