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
            <a href="{!! route('home.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-calendar"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Today 3W</span>
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
            <a href="{!! route('home.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-database"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Created 3W</span>
                <span class="info-box-number">
                    @isset($count)
                        {{ number_format($count) }}
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
            <a href="{!! route('tw.create') !!}">
                <span class="info-box-icon bg-aqua"><i class="ion ion-person-add"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Create New 3W</span>
                <span class="info-box-number">
                    @isset($count)
                        {{ number_format($count) }}
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
            <a href="{!! route('home.index') !!}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-bookmark-o"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Find 3W</span>
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
    
</div>
<!-- /.row -->
@endsection
