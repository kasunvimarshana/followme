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
            <a href="{{ route('user.create') }}">
                <span class="info-box-icon bg-aqua"><i class="fa  fa-plus-square-o"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">Add</span>
                <span class="progress-description">Add New User</span>
                <!-- span class="info-box-number">0</span -->
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
            <a href="{{ route('user.list') }}">
                <span class="info-box-icon bg-aqua"><i class="fa fa-table"></i></span>
            </a>
            <!-- info-box-content -->
            <div class="info-box-content">
                <span class="info-box-text">List Users</span>
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
    
</div>
<!-- /.row -->
@endsection
