@extends('layouts.home_layout')

@section('section_stylesheet')
    @parent
@endsection

@section('section_script_main')
    @parent
@endsection

@section('content')
<!-- row -->
<div class="row">
    
    <!-- col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <!-- info-box -->
        <div class="info-box">
            <a href="{{ url('/config/user') }}">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-add"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">User</span>
                <span class="info-box-number">10</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
    <!-- col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <!-- info-box -->
        <div class="info-box">
            <a href="{{ url('/config/meeting') }}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Meeting</span>
                <span class="info-box-number">10</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
    <!-- col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <!-- info-box -->
        <div class="info-box">
            <a href="{{ url('/meeting/tw') }}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bookmark-o"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">3W</span>
                <span class="info-box-number">10</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
    <!-- col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <!-- info-box -->
        <div class="info-box">
            <a href="{{ url('/config/location') }}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-flag-o"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Location</span>
                <span class="info-box-number">10</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
    <!-- col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <!-- info-box -->
        <div class="info-box">
            <a href="{{ url('/config/department') }}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-tree"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Department</span>
                <span class="info-box-number">10</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
    <!-- col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <!-- info-box -->
        <div class="info-box">
            <a href="{{ url('/config/meeting_type') }}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bookmark-o"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Meeting Type</span>
                <span class="info-box-number">10</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
    <!-- col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <!-- info-box -->
        <div class="info-box">
            <a href="{{ url('/config/meeting_group') }}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-group"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Group</span>
                <span class="info-box-number">10</span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
</div>
<!-- /.row -->
@endsection
