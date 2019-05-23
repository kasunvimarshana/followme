@extends('layouts.home_layout')

@section('section_stylesheet')
    @parent
    <!-- Bootstrap Toggle -->
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-toggle/css/bootstrap-toggle.min.css') }}" />
    <!-- Bootstrap Slider -->
    <link rel="stylesheet" href="{{ asset('node_modules/bootstrap-slider/dist/css/bootstrap-slider.min.css') }}" />
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
                        <a data-toggle="collapse" data-parent="#collapseOneParent" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> Schedule for 3W Owners</a>
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
                                <form action="{!! '#' !!}" method="POST" class="col-sm-8" autocomplete="off" id="form1" enctype="multipart/form-data">
                                    @csrf
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="user_pk" class="col-sm-2 control-label">Recurrent</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input class="form-control" id="is_recurring" name="useis_recurringr_pk" value="{{ old('is_recurring') }}" type="checkbox" data-toggle="toggle"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="hour" class="col-sm-2 control-label" title="Hour">H (1 - 24)</label>
                                        <div class="col-sm-10">
                                            @php
                                                $hourInputRange = range(0,24,1);
                                                $hourInputRange = implode(" ,", $hourInputRange);
                                            @endphp
                                            <!-- p class="form-control-static"></p -->
                                            <input class="form-control" id="hour" name="hour" value="{{ old('hour') }}" data-provide="slider" data-slider-ticks="[{!! $hourInputRange !!}]" data-slider-ticks-labels='[{!! $hourInputRange !!}]' data-slider-min="0" data-slider-max="24" data-slider-step="1" data-slider-value="{{ old('hour') }}" data-slider-tooltip="hide" style="width: 100%;"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="user_pk" class="col-sm-2 control-label" title="Day Of Week">DOW (1 - 7)(7=Sunday)</label>
                                        <div class="col-sm-10">
                                            @php
                                                $dowInputRange = range(0,7,1);
                                                $dowInputRange = implode(" ,", $dowInputRange);
                                            @endphp
                                            <!-- p class="form-control-static"></p -->
                                            <input class="form-control" id="hour" name="hour" value="{{ old('hour') }}" data-provide="slider" data-slider-ticks="[{!! $dowInputRange !!}]" data-slider-ticks-labels='[{!! $dowInputRange !!}]' data-slider-min="0" data-slider-max="24" data-slider-step="1" data-slider-value="{{ old('hour') }}" data-slider-tooltip="hide" style="width: 100%;"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="user_pk" class="col-sm-2 control-label" title="Month">M (1 - 12)</label>
                                        <div class="col-sm-10">
                                            @php
                                                $monthInputRange = range(0,12,1);
                                                $monthInputRange = implode(" ,", $monthInputRange);
                                            @endphp
                                            <!-- p class="form-control-static"></p -->
                                            <input class="form-control" id="hour" name="hour" value="{{ old('hour') }}" data-provide="slider" data-slider-ticks="[{!! $monthInputRange !!}]" data-slider-ticks-labels='[{!! $monthInputRange !!}]' data-slider-min="0" data-slider-max="24" data-slider-step="1" data-slider-value="{{ old('hour') }}" data-slider-tooltip="hide" style="width: 100%;"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <!-- btn-toolbar -->
                                        <div class="col col-sm-12">
                                            <!-- div class="btn-group btn-group-lg pull-right" -->
                                                <button type="submit" class="btn btn-primary pull-right" id="submit">Submit</button>
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
            <div id="collapseOneParent" class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#collapseOneParent" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> Schedule for HOD</a>
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
                                <form action="{!! '#' !!}" method="POST" class="col-sm-8" autocomplete="off" id="form1" enctype="multipart/form-data">
                                    @csrf
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="user_pk" class="col-sm-2 control-label">Tag With HOD</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input class="form-control" id="is_recurring" name="useis_recurringr_pk" value="{{ old('is_recurring') }}" type="checkbox" data-toggle="toggle"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="user_pk" class="col-sm-2 control-label">Recurrent</label>
                                        <div class="col-sm-10">
                                            <!-- p class="form-control-static"></p -->
                                            <input class="form-control" id="is_recurring" name="useis_recurringr_pk" value="{{ old('is_recurring') }}" type="checkbox" data-toggle="toggle"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="hour" class="col-sm-2 control-label" title="Hour">H (1 - 24)</label>
                                        <div class="col-sm-10">
                                            @php
                                                $hourInputRange = range(0,24,1);
                                                $hourInputRange = implode(" ,", $hourInputRange);
                                            @endphp
                                            <!-- p class="form-control-static"></p -->
                                            <input class="form-control" id="hour" name="hour" value="{{ old('hour') }}" data-provide="slider" data-slider-ticks="[{!! $hourInputRange !!}]" data-slider-ticks-labels='[{!! $hourInputRange !!}]' data-slider-min="0" data-slider-max="24" data-slider-step="1" data-slider-value="{{ old('hour') }}" data-slider-tooltip="hide" style="width: 100%;"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="user_pk" class="col-sm-2 control-label" title="Day Of Week">DOW (1 - 7)(7=Sunday)</label>
                                        <div class="col-sm-10">
                                            @php
                                                $dowInputRange = range(0,7,1);
                                                $dowInputRange = implode(" ,", $dowInputRange);
                                            @endphp
                                            <!-- p class="form-control-static"></p -->
                                            <input class="form-control" id="hour" name="hour" value="{{ old('hour') }}" data-provide="slider" data-slider-ticks="[{!! $dowInputRange !!}]" data-slider-ticks-labels='[{!! $dowInputRange !!}]' data-slider-min="0" data-slider-max="24" data-slider-step="1" data-slider-value="{{ old('hour') }}" data-slider-tooltip="hide" style="width: 100%;"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->
                                    
                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <label for="user_pk" class="col-sm-2 control-label" title="Month">M (1 - 12)</label>
                                        <div class="col-sm-10">
                                            @php
                                                $monthInputRange = range(0,12,1);
                                                $monthInputRange = implode(" ,", $monthInputRange);
                                            @endphp
                                            <!-- p class="form-control-static"></p -->
                                            <input class="form-control" id="hour" name="hour" value="{{ old('hour') }}" data-provide="slider" data-slider-ticks="[{!! $monthInputRange !!}]" data-slider-ticks-labels='[{!! $monthInputRange !!}]' data-slider-min="0" data-slider-max="24" data-slider-step="1" data-slider-value="{{ old('hour') }}" data-slider-tooltip="hide" style="width: 100%;"/>
                                        </div>
                                        <!-- span id="form-control" class="help-block"></span -->
                                    </div>
                                    <!-- /.form-group -->

                                    <!-- form-group -->
                                    <div class="form-group col-sm-12">
                                        <!-- btn-toolbar -->
                                        <div class="col col-sm-12">
                                            <!-- div class="btn-group btn-group-lg pull-right" -->
                                                <button type="submit" class="btn btn-primary pull-right" id="submit">Submit</button>
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
        </div>
        <!-- /.accordion -->
        
    </div>
    <!-- /.col -->
    
</div>
<!-- /.row -->
@endsection

@section('section_script')
    @parent
    <!-- Bootstrap Toggle -->
    <script src="{{ asset('node_modules/bootstrap-toggle/js/bootstrap-toggle.min.js') }}"></script>
    <!-- Bootstrap Slider -->
    <script src="{{ asset('node_modules/bootstrap-slider/dist/bootstrap-slider.min.js') }}"></script>
    <script>
    $(function() {
        "use strict";
    });
    </script>
@endsection