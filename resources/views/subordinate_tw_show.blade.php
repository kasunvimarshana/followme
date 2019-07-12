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
                        <a data-toggle="collapse" data-parent="#collapseOneParent" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> Filter</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse out">
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
                                        <label for="created_user" class="col-sm-2 control-label">Assigned by</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <select class="form-control select2" id="created_user" name="created_user" value="{{ old('created_user') }}" data-placeholder="Assigned by" style="width: 100%;">
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
                                                    <input type="text" class="form-control pull-right" id="start_date" name="start_date" placeholder="Start Date" value="{{ old('start_date') }}"/>
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
                                                    <input type="text" class="form-control pull-right" id="due_date" name="due_date" placeholder="Due Date" value="{{ old('due_date') }}"/>
                                                </div>
                                            </div>
                                            <!-- span id="form-control" class="help-block"></span -->
                                        </div>
                                        <!-- /.form-group -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="status_id" class="col-sm-2 control-label">Job Status</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <select class="form-control select2" id="status_id" name="status_id" value="{{ old('status_id') }}" style="width: 100%;">
                                                <option value=""> All </option>
                                                <option value="{!! App\Enums\TWStatusEnum::OPEN !!}"> Open </option>
                                                <option value="{!! App\Enums\TWStatusEnum::CLOSE !!}"> Closed </option>
                                                <option value="{!! App\Enums\TWStatusEnum::INPROGRESS !!}"> Inprogress </option>
                                                <option value="{!! App\Enums\TWStatusEnum::PASS !!}"> Pass </option>
                                                <option value="{!! App\Enums\TWStatusEnum::FAIL !!}"> Fail </option>
                                                <option value="{!! App\Enums\TWStatusEnum::COMPLETED !!}"> Done </option>
                                                <option value="{!! App\Enums\TWStatusEnum::FAIL_WITH_COMPLETED !!}"> Fail (Close) </option>
                                                <option value="{!! App\Enums\TWStatusEnum::FAIL_WITH_UNCOMPLETED !!}"> Fail (Open) </option>
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
                                                <button type="submit" class="btn btn-primary pull-right" id="submit">Search</button>
                                                <button type="reset" class="btn btn-info pull-right" id="reset">Reset</button>
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
                        <a data-toggle="collapse" data-parent="#collapseTwoParent" href="#collapseTwo"><span class="glyphicon glyphicon-plus"></span> Assigned To 
                            @isset($directReportUser)
                                <strong>{!! $directReportUser->mail !!}</strong>
                            @endisset
                        </a>
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
                                <!-- class="table table-striped table-bordered dt-responsive nowrap" -->
                                <table id="twDataTable" class="table table-bordered" style="width:100%" width="100%" cellspacing="0" border="1" align="left"></table>
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
    @includeIf('partials.tw_summary.tw_created_user_select', array())
    @includeIf('partials.tw_summary.tw_data_table_direct_report_all', array())
    <script>
    $(function() {
        "use strict";
        
        $('#start_date').datepicker({
            'autoclose': true,
            'format': "yyyy-mm-dd",
            'immediateUpdates': true,
            'todayBtn': true,
            'todayHighlight': true,
            'clearBtn': true
        });//.datepicker("setDate", new Date());
        
        $('#due_date').datepicker({
            'autoclose': true,
            'format': "yyyy-mm-dd",
            'immediateUpdates': true,
            'todayBtn': true,
            'todayHighlight': true,
            'clearBtn': true
        });//.datepicker("setDate", $('#start_date').val());
        
        $('#status_id').select2();
        
        @if((isset($progressVal)) && (!empty($progressVal)))
            var status_id = $('#status_id');
            $('#status_id').val({!! $progressVal !!}).trigger('change');
        @endif
        
        $('#reset').on('click', function(event){
            //$("form").get(0).reset();
            //$('form > input[type=reset]').trigger('click');
            var tableObj = $('#twDataTable');
            $('#created_user').val(null).trigger('change');
            $('#meeting_category_id').val(null).trigger('change');
            $('#status_id').val(null).trigger('change');
            //$('#twDataTable').DataTable().ajax.reload( null, false ); // user paging is not 
            
            tableObj.removeData();
            $('#twForm').trigger('submit');
        });
        
        $('#twForm').submit(function(event) {
            event.preventDefault();
            
            var tableObj = $('#twDataTable');
            var created_user = $('#created_user');
            var meeting_category_id = $('#meeting_category_id');
            var title = $('#title');
            var start_date = $('#start_date');
            var due_date = $('#due_date');
            var status_id = $('#status_id');
            
            var created_user_val = created_user.val();
            var meeting_category_id_val = meeting_category_id.val();
            var title_val = title.val();
            var start_date_val = start_date.val();
            var due_date_val = due_date.val();
            var status_id_val = status_id.val();
            
            tableObj.removeData();
            
            if( created_user_val ){
               tableObj.data('created_user', created_user_val);
            }
            if( meeting_category_id_val ){
               tableObj.data('meeting_category_id', meeting_category_id_val);
            }
            if( title_val ){
               tableObj.data('title', title_val);
            }
            if( start_date_val ){
               tableObj.data('start_date', start_date_val);
            }
            if( due_date_val ){
               tableObj.data('due_date', due_date_val);
            }
            if( status_id_val ){
               tableObj.data('status_id', status_id_val);
            }
            
            tableObj.DataTable().ajax.reload( null, false ); // user paging is not reset on reload
            // scroll top
            $('html, body').animate({scrollTop:0}, 'slow');
        });
        
        $('#twForm').trigger('submit');
    });
    </script>
@endsection