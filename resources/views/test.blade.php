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
                        <a data-toggle="collapse" data-parent="#collapseOneParent" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> Search User</a>
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
                                <form action="#" method="GET" class="col-sm-8" autocomplete="off" id="userSearchForm">
                                    @csrf
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="name" class="col-sm-2 control-label">Name</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="email" class="col-sm-2 control-label">E-mail</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="{{ old('email') }}"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="epf_no" class="col-sm-2 control-label">EPF-NO</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="text" class="form-control" id="epf_no" name="epf_no" placeholder="EPF-NO" value="{{ old('epf_no') }}"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="phone" class="col-sm-2 control-label">Phone</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" value="{{ old('phone') }}"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="user_position_id" class="col-sm-2 control-label">Position</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <select class="form-control select2" id="user_position_id" name="user_position_id" value="{{ old('user_position_id') }}" data-placeholder="Position" style="width: 100%;">
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
                                            <select class="form-control select2" id="department_id" name="department_id" value="{{ old('department_id') }}" data-placeholder="Department" style="width: 100%;">
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
                                                <button type="submit" class="btn btn-primary pull-right">Search</button>
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
                        <a data-toggle="collapse" data-parent="#collapseTwoParent" href="#collapseTwo"><span class="glyphicon glyphicon-plus"></span> Users</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse in">
                    <div class="panel-body">
                        
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-sm-12">
                                <!-- table -->
                                <table id="userDataTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%"></table>
                                <!-- /.table -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                        
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

    @includeIf('partials.user_position_select')
    @includeIf('partials.department_select')
    @includeIf('partials.user_data_table')
    <script>
        $(function(){
            var userSearchForm = $('#userSearchForm');
            userSearchForm.submit(function(event){
                event.preventDefault();
                var userDataTable = $('#userDataTable').DataTable();
                userDataTable.ajax.reload( null, false ); // user paging is not reset on reload
            });
        });
    </script>
@endsection