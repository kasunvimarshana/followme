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
            <a href="{!! route('user.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-add"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">User</span>
                <span class="info-box-number">
                    @isset($userCount)
                        {{ number_format($userCount) }}
                    @endisset
                </span>
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
            <a href="{!! route('meeting.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Meeting</span>
                <span class="info-box-number">
                    @isset($meetingCount)
                        {{ number_format($meetingCount) }}
                    @endisset
                </span>
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
            <a href="{!! route('meetingTW.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bookmark-o"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">3W</span>
                <span class="info-box-number">
                    @isset($meetingTWCount)
                        {{ number_format($meetingTWCount) }}
                    @endisset
                </span>
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
            <a href="{!! route('companyLocation.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-flag-o"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Location</span>
                <span class="info-box-number">
                    @isset($companyLocationCount)
                        {{ number_format($companyLocationCount) }}
                    @endisset
                </span>
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
            <a href="{!! route('department.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-tree"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Department</span>
                <span class="info-box-number">
                    @isset($departmentCount)
                        {{ number_format($departmentCount) }}
                    @endisset
                </span>
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
            <a href="{!! route('meetingType.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bookmark-o"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Meeting Type</span>
                <span class="info-box-number">
                    @isset($meetingTypeCount)
                        {{ number_format($meetingTypeCount) }}
                    @endisset
                </span>
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
            <a href="{!! route('meetingGroup.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-group"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Group</span>
                <span class="info-box-number">
                    @isset($meetingGroupCount)
                        {{ number_format($meetingGroupCount) }}
                    @endisset
                </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    
</div>
<!-- /.row -->
@endsection
