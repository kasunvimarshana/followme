@extends('layouts.home_layout')

@section('section_stylesheet')
    @parent
    <!-- DataTable -->
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('node_modules/datatables.net-select-bs/css/select.bootstrap.min.css') }}" />
    <!-- ChartJS -->
    <link rel="stylesheet" href="{{ asset('node_modules/chart.js/dist/Chart.min.css') }}" />
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
                        <a data-toggle="collapse" data-parent="#collapseOneParent" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> Today Events</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
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
            
            <!-- panel -->
            <div id="collapseThreeParent" class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#collapseThreeParent" href="#collapseThree"><span class="glyphicon glyphicon-plus"></span> Event Progress</a>
                    </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <!-- --- -->
                        
                        <!-- row -->
                        <div class="row">
                            <!-- col -->
                            <div class="col-sm-6">
                                <!-- canvas -->
                                <canvas id="twChart" style="height:250px"></canvas>
                                <!-- /.canvas -->
                            </div>
                            <!-- /.col -->
                            
                            <!-- col -->
                            <div class="col-sm-6">
                                <!-- table -->
                                <table id="twProgressDataTable" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%"></table>
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
            
            <!-- panel -->
            <div id="collapseTwoParent" class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#collapseTwoParent" href="#collapseTwo"><span class="glyphicon glyphicon-plus"></span> Actions</a>
                    </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse in">
                    <div class="panel-body">
                        
                        <!-- --- -->
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
                                            @isset($twTodayCount)
                                                {{ number_format($twTodayCount) }}
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
                                    <a href="{!! route('tw.showCreatedTW') !!}">
                                        <span class="info-box-icon bg-aqua"><i class="fa fa-database"></i></span>
                                    </a>
                                    <!-- info-box-content -->
                                    <div class="info-box-content">
                                        <span class="info-box-text">Created 3W</span>
                                        <span class="info-box-number">
                                            @isset($twTodayCreatedCount)
                                                {{ number_format($twTodayCreatedCount) }}
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
                                    <a href="{!! route('tw.showOwneTW') !!}">
                                        <span class="info-box-icon bg-aqua"><i class="fa fa-bookmark-o"></i></span>
                                    </a>
                                    <!-- info-box-content -->
                                    <div class="info-box-content">
                                        <span class="info-box-text">Owne 3W</span>
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
    <!-- DataTable -->
    <script src="{{ asset('node_modules/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-responsive-bs/js/responsive.bootstrap.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-scroller-bs/js/scroller.bootstrap.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select/js/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('node_modules/datatables.net-select-bs/js/select.bootstrap.min.js') }}"></script>
    <!-- ChartJS -->
    <script src="{{ asset('node_modules/chart.js/dist/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('node_modules/chart.js/dist/Chart.min.js') }}"></script>
    @includeIf('partials.tw_data_table_today_pending', array())
    @includeIf('partials.tw_data_table_progress', array())

    <script>
    //var canvasCtx = $('#twChart').get(0).getContext('2d');
    var canvasCtx = $('#twChart').get(0).getContext('2d');
    var chartConfig = {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    @isset($twPassCount)
                        {!! $twPassCount !!}
                    @endisset
                    ,
                    @isset($twPassCount)
                        {!! $twFailCount !!}
                    @endisset
                ],
                backgroundColor: [
                    'rgba(0, 255, 0, 1)',
                    'rgba(255, 0, 0, 1)'
                ],
                label: [
                    {!! App\Enums\TWStatusEnum::OPEN !!},
                    {!! App\Enums\TWStatusEnum::CLOSE !!}
                ]
            }],
            labels: [
                'Pass',
                'Fail'
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            legend: {
                position: 'right',
            },
            tooltips: {
                mode: 'nearest'
            },
            title: {
                display: true,
                text: 'Chart'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
            'onClick': function (event, item) {
                //var activePoints = chart.getElementsAtEvent(event);
                var itemArray = Array.from( item );
                var itemObj = itemArray.shift();
                try{
                    var tableObj = $('#twProgressDataTable');
                    if( itemObj ){
                        var _model_val = itemObj._model;
                        var label_val = _model_val.label;
                        //var data = tableObj.DataTable().ajax.json();
                        //var data = tableObj.DataTable().ajax.params();
                        twProgressDataTableCustomData.status_id = label_val;
                    }else{
                        twProgressDataTableCustomData.status_id = null;
                    }
                    tableObj.DataTable().ajax.reload( null, false ); // user paging is not reset on reload
                }catch( e ){}
            }
        }
    }
    var chartObj = new Chart(canvasCtx, chartConfig); 
    </script>
@endsection