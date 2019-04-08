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
                        <a data-toggle="collapse" data-parent="#collapseOneParent" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> 3W</a>
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
                                <form action="{!! route('tw.store') !!}" method="POST" class="col-sm-8" autocomplete="off" id="twForm">
                                    @csrf
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="own_user" class="col-sm-2 control-label">Owner</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <select class="form-control select2" id="own_user" name="own_user[]" value="{{ old('own_user[]') }}" data-placeholder="Owner" style="width: 100%;" multiple="multiple">
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
                                            <input type="text" class="form-control" id="title" name="title" placeholder="3W" value="{{ old('title') }}"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="due_date" class="col-sm-2 control-label">Due Date</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <div class="input-group date">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </div>
                                                <input type="text" class="form-control pull-right" id="due_date" name="due_date" placeholder="Due Date" value="{{ old('due_date') }}"/>
                                            </div>
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
                        <!-- --- -->
                    </div>
                </div>
            </div>
            <!-- /.panel -->
            <!-- panel -->
            <div id="collapseTwoParent" class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#collapseTwoParent" href="#collapseTwo"><span class="glyphicon glyphicon-plus"></span> 3W</a>
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

    @includeIf('partials.meeting_category_select')
    @includeIf('partials.tw_own_user_select')
    @includeIf('partials.tw_data_table')
    <script>
    $(function() {
        "use strict";
        
        $('#due_date').datepicker({
            'autoclose': true,
            'format': "yyyy-mm-dd",
            'immediateUpdates': true,
            'todayBtn': true,
            'todayHighlight': true
        }).datepicker("setDate", new Date());
        
        $('#twForm').submit(function(event) {
            event.preventDefault();
            var form = $(this);
            var form_id = $(this).attr('id');
            var _token = '{{ Session::token() }}';

            var own_user = form.find('#own_user');
            var meeting_category_id = form.find('#meeting_category_id');
            var title = form.find('#title');
            var due_date = form.find('#due_date');
            var description = form.find('#description');

            var formdata = new FormData();

            formdata.append('_token', _token);
            formdata.append('own_user[]', own_user.val());
            formdata.append('meeting_category_id', meeting_category_id.val());
            formdata.append('title', title.val());
            formdata.append('due_date', due_date.val());
            formdata.append('description', description.val());
            formdata.append('submit', true);
            // process the form
            $.ajax({
                type        : form.attr('method'), // define the type of HTTP verb we want to use (POST for our form)
                url         : form.attr('action'), // the url where we want to POST
                data        : formdata, // our data object
                //dataType    : 'json', // what type of data do we expect back from the server
                //encode      : true,
                processData : false,
                contentType : false
            })
                // using the done promise callback
                .done(function(data) {
                    console.log(data);
                    swal({
                        'title': data.title,
                        'text': data.text,
                        'type': data.type,
                        'timer': data.timer,
                        'showConfirmButton': false
                    });
                    $('#twDataTable').DataTable().ajax.reload( null, false ); // user paging is not reset on reload
                    title.val(null);
                    description.val(null);
                    due_date.datepicker("setDate", new Date());
                })
                .fail(function() {
                    //console.log( "error" );
                })
                .always(function() {
                    //console.log( "complete" );
                });
        });
    });
    </script>
@endsection