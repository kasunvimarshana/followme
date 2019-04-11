@extends('layouts.home_layout')

@section('section_stylesheet')
    @parent
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/select2/dist/css/select2.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/select2-bootstrap-theme/dist/select2-bootstrap.min.css') }}" />
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs/css/select.bootstrap.min.css') }}" />
    <!-- Bootstrap Datepicker -->
    <link rel="stylesheet" href="{{ asset('node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}" />
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
                        <a data-toggle="collapse" data-parent="#collapseOneParent" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> Search Created 3W</a>
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
                                <form action="#" method="POST" class="col-sm-8" autocomplete="off" id="twForm" enctype="multipart/form-data">
                                    @csrf
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="own_user" class="col-sm-2 control-label">Owner</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <select class="form-control select2" id="own_user" name="own_user" value="{{ old('own_user') }}" data-placeholder="Owner" style="width: 100%;">
                                            </select>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="meeting_category_id" class="col-sm-2 control-label">Category</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <select class="form-control select2" id="meeting_category_id" name="meeting_category_id" value="{{ old('meeting_category_id') }}" data-placeholder="Category" style="width: 100%;">
                                            </select>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="title" class="col-sm-2 control-label">3W</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="text" class="form-control" id="title" name="title" placeholder="3W" value="{{ old('title') }}" required/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <!-- skip div -->
                                        <div class="col-sm-2"></div>
                                        <!-- /.skip div -->
                                        
                                        <!-- form-group -->
                                        <div class="form-group col-sm-12 col-md-5 col-lg-5">
                                            <label for="start_date" class="col-sm-2 control-label">Start Date</label>
                                            <div class="col-sm-10">
                                                <!-- p class="form-control-static"></p -->
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="start_date" name="start_date" placeholder="Start Date" value="{{ old('start_date') }}" required/>
                                                </div>
                                            </div>
                                            <!-- span id="form-control" class="help-block"></span -->
                                        </div>
                                        <!-- /.form-group -->
                                        
                                        <!-- form-group -->
                                        <div class="form-group col-sm-12 col-md-5 col-lg-5">
                                            <label for="due_date" class="col-sm-2 control-label">Due Date</label>
                                            <div class="col-sm-10">
                                                <!-- p class="form-control-static"></p -->
                                                <div class="input-group date">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </div>
                                                    <input type="text" class="form-control pull-right" id="due_date" name="due_date" placeholder="Due Date" value="{{ old('due_date') }}" required/>
                                                </div>
                                            </div>
                                            <!-- span id="form-control" class="help-block"></span -->
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <!-- btn-toolbar -->
                                        <div class="col col-sm-12">
                                            <!-- div class="btn-group btn-group-lg pull-right" -->
                                                <button type="submit" class="btn btn-primary pull-right" id="submit">Search</button>
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
                        <a data-toggle="collapse" data-parent="#collapseTwoParent" href="#collapseTwo"><span class="glyphicon glyphicon-plus"></span> Created 3W</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse in">
                    <div class="panel-body">
                        
                        <!-- --- -->
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-sm-12">
                                <!-- table -->
                                <table id="twDataTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%"></table>
                                <!-- /.table -->
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
    <!-- DataTable -->
    <script src="{{ asset('node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-responsive-bs/js/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-scroller-bs/js/scroller.bootstrap.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs/js/select.bootstrap.min.js') }}"></script>
    <!-- Bootstrap Datepicker -->
    <script src="{{ asset('node_modules/admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('node_modules/admin-lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>

    @includeIf('partials.meeting_category_select', array())
    @includeIf('partials.tw_summary.tw_own_user_select', array())
    @includeIf('partials.tw_summary.tw_data_table_created_all', array())
    <script>
    $(function() {
        "use strict";
        
        $('#start_date').datepicker({
            'autoclose': true,
            'format': "yyyy-mm-dd",
            'immediateUpdates': true,
            'todayBtn': true,
            'todayHighlight': true
        }).datepicker("setDate", new Date());
        
        $('#due_date').datepicker({
            'autoclose': true,
            'format': "yyyy-mm-dd",
            'immediateUpdates': true,
            'todayBtn': true,
            'todayHighlight': true
        }).datepicker("setDate", $('#start_date').val());
        
        $('#twForm').submit(function(event) {
            event.preventDefault();
        });
    });
    </script>
@endsection