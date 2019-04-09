@extends('layouts.home_layout')

@section('section_stylesheet')
    @parent
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
                        <a data-toggle="collapse" data-parent="#collapseOneParent" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> Today 3W</a>
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
                        <a data-toggle="collapse" data-parent="#collapseThreeParent" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> 3W</a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in">
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
                                <!-- img -->
                                @if( (isset($auth_user)) && ($auth_user->thumbnailphoto) )
                                    <img src="data:image/jpeg;base64, {!! base64_encode( $auth_user->thumbnailphoto ) !!}" class="img-responsive img-thumbnail" alt="User Image"/>
                                @else
                                    <img src="{!! URL::asset('node_modules/admin-lte/dist/img/avatar5.png') !!}" class="img-responsive img-thumbnail" alt="User Image"/>
                                @endif
                                <!-- /.img -->
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
                                            @isset($twToday)
                                                {{ number_format($twToday) }}
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
                                            @isset($twTodayCreated)
                                                {{ number_format($twTodayCreated) }}
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
    <script src="{{ asset('node_modules/admin-lte/bower_components/chart.js/Chart.js') }}"></script>
    @includeIf('partials.tw_data_table_today_pending')

    <script>
    var pieChartCanvas = $('#twChart').get(0).getContext('2d')
    var pieChart       = new Chart(pieChartCanvas)
    var PieData        = [
      {
        value    : 300,
        color    : '#f56954',
        highlight: '#f56954',
        label    : 'Fail'
      },
      {
        value    : 700,
        color    : '#00a65a',
        highlight: '#00a65a',
        label    : 'Success'
      }
    ]
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
    </script>
@endsection