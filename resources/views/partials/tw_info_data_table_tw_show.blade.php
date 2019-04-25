<!-- script>
$(function(){
    "use strict";
    var dataTableUserList = $('#userDataTable').DataTable();
});
</script -->

<script>
$(function(){
    "use strict";
    //$.fn.dataTable.ext.errMode = 'none';
    //$.fn.dataTableExt.errMode = 'ignore';
    $.fn.dataTableExt.sErrMode = "console";
    var dataTableTWInfoList = $('#twInfoDataTable').DataTable({
        'columns' : [/*{
            'title' : '',
            'className' : 'details-control',
            'orderable' : false,
            'className' : 'center',
            'data' : null,
            'defaultContent' : '',
            'render' : function(data, type, row){
                //$.fn.dataTable.render.number( ',', '.', 0, '$' );
                return data.epf_no;
            }
        },*/{
            'title' : 'User',
            'orderable' : false,
            'data' : 'created_user',
            'render' : function(data, type, row){
                var formatted_data = data;
                formatted_data = formatted_data.substring(0, formatted_data.lastIndexOf('@'));
                return formatted_data;
            }
        },{
            'title' : 'Description',
            'orderable' : false,
            'data' : 'description',
            'render' : function(data, type, row){
                return data;
            }
        },{
            'title' : '',
            'orderable' : false,
            'className' : 'center',
            'data' : null,
            'render' : function(data, type, row){
                return '';
            }
        }],
        'responsive' : false,
        'scrollX' : true,
        'paging' : true,
        'lengthChange' : true,
        'lengthMenu' : [[5, 10, 25, 50, 100, {!! PHP_INT_MAX !!}], [5, 10, 25, 50, 100, 'all']],
        'searching' : true,
        'ordering' : false,
        'info' : true,
        'autoWidth' : true,
        'processing' : false,
        'serverSide' : true,
        'jQueryUI' : false,
        'initComplete' : function(){
            //console.log("initComplete");
            //$(this).show();
        },
        'ajax' : {
            'url' : "{!! route('twInfo.list') !!}",
            'cache' : true,
            'dataSrc' : 'data',
            'type' : 'GET',
            'deferRender' : true,
            //'dataType' : 'json',
            'delay' : 300,
            'data' : function(data){
                //console.log(data);
                data.t_w_id = "{!! $tW->id !!}";
            },
            'error' : function(e){
                //console.log(e);
            }
        },
        'rowCallback' : function(row, data, displayNum, displayIndex, dataIndex){},
        'createRow' : function(row, data, dataIndex){},
        //'order' : [[1, 'asc']],
        'columnDefs' : [{
            'targets' : [1, 2],
            'responsivePriorty' : 1
        },{
            'targets' : [-1],
            'responsivePriority' : 2,
            'visible' : true,
            //'width' : '250px',
            'data' : null, // Use the full data source object for the renderer's source
            'createdCell' : function(td, cellData, rowData, row, col){
                var parentTd = $(td);
                parentTd.empty();
                
                var buttonToolbar = $('<div></div>');
                buttonToolbar.addClass('btn-toolbar');//pull-left
                //button group
                var buttonGroup_1 = $('<div></div>');
                buttonGroup_1.addClass('btn-group');
                var button_1 = $('<button></button>');
                button_1.addClass('btn btn-info btn-sm');
                var button_1_body = $('<i></i>');
                button_1_body.addClass('fa fa-edit');
                button_1_body.attr('data-toggle', 'tooltip');
                button_1_body.attr('data-placement', 'auto');
                button_1_body.attr('data-container', 'body');
                //button_1_body.attr('title', 'title');
                button_1_body.attr('data-title', 'Edit');
                //button_1_body.attr('data-content', 'content');
                button_1_body.tooltip();
                //button_1_body.text('text');
                button_1.bind("click", function(){
                    var url = "{!! route('twInfo.edit', ['#tWInfo']) !!}";
                    url = url.replace("#tWInfo", rowData.id);
                    $( location ).attr("href", url);
                });
                button_1.append(button_1_body);
                buttonGroup_1.append(button_1);
                
                //button group
                var buttonGroup_2 = $('<div></div>');
                buttonGroup_2.addClass('btn-group');
                var button_2 = $('<button></button>');
                button_2.addClass('btn btn-danger btn-sm');
                var button_2_body = $('<i></i>');
                button_2_body.addClass('fa fa-trash-o');
                button_2_body.attr('data-toggle', 'tooltip');
                button_2_body.attr('data-placement', 'auto');
                button_2_body.attr('data-container', 'body');
                //button_2_body.attr('title', 'title');
                button_2_body.attr('data-title', 'Delete');
                //button_2_body.attr('data-content', 'content');
                button_2_body.tooltip();
                button_2.bind("click", function(){
                    button_2.attr("disabled", true);
                    bootbox.confirm({
                        message: "are you sure",
                        buttons: {
                            confirm: {
                                label: 'Yes',
                                className: 'btn-success'
                            },
                            cancel: {
                                label: 'No',
                                className: 'btn-danger'
                            }
                        },
                        callback: function (result) {
                            //console.log('This was logged in the callback: ' + result);
                            if( result == true ){
                                var url = "{!! route('twInfo.destroy', ['#tWInfo']) !!}";
                                url = url.replace("#tWInfo", rowData.id);
                                //$( location ).attr("href", url);
                                
                                $.ajax({
                                    type: "GET",
                                    url: url,
                                    data: null,
                                    //success: success,
                                    //dataType: dataType,
                                    //context: document.body
                                })
                                .done(function( data ) {
                                    swal({
                                        'title': data.title,
                                        'text': data.text,
                                        'type': data.type,
                                        'timer': data.timer,
                                        'showConfirmButton': false
                                    });
                                    $('#twInfoDataTable').DataTable().ajax.reload( null, false ); // user paging is not reset on reload
                                })
                                .fail(function() {
                                    //console.log( "error" );
                                    alert('fail');
                                })
                                .always(function() {
                                    //console.log( "finished" );
                                    button_2.attr("disabled", false);
                                });
                                
                            }else{
                                button_2.attr("disabled", false);
                            }
                        }
                    });
                    
                })
                button_2.append(button_2_body);
                buttonGroup_2.append(button_2);
                
                //button group
                var buttonGroup_3 = $('<div></div>');
                buttonGroup_3.addClass('btn-group');
                var button_3 = $('<button></button>');
                button_3.addClass('btn btn-success btn-sm');
                var button_3_body = $('<i></i>');
                button_3_body.addClass('fa fa-eye');
                button_3_body.attr('data-toggle', 'tooltip');
                button_3_body.attr('data-placement', 'auto');
                button_3_body.attr('data-container', 'body');
                //button_3_body.attr('title', 'title');
                button_3_body.attr('data-title', 'View');
                //button_3_body.attr('data-content', 'content');
                button_3_body.tooltip();
                button_3.bind("click", function(){
                    var url = "{!! route('twInfo.show', ['#tWInfo']) !!}";
                    url = url.replace("#tWInfo", rowData.id);
                    $( location ).attr("href", url);
                });
                button_3.append(button_3_body);
                buttonGroup_3.append(button_3);
                
                buttonToolbar.append(buttonGroup_3);
                //buttonToolbar.append(buttonGroup_1);
                //buttonToolbar.append(buttonGroup_2);
                
                var popoverButtonToolbar = $('<div></div>');
                popoverButtonToolbar.addClass('btn-toolbar pull-left');
                var popoverButtonGroup_1 = $('<div></div>');
                popoverButtonGroup_1.addClass('btn-group');
                
                var popoverToggleButton = $('<button></button>');
                var popoverToggleButtonId = 'id-' + moment().format('HH-mm-ss-SSS');
                popoverToggleButton.addClass('btn btn-primary btn-sm my-popover');
                popoverToggleButton.attr('id', popoverToggleButtonId);
                popoverToggleButton.attr('data-toggle', 'popover');
                popoverToggleButton.attr('data-placement', 'auto');
                popoverToggleButton.attr('data-container', 'body');
                var popoverToggleButtonSpan = $('<span></span>');
                popoverToggleButtonSpan.addClass('fa fa-gears');
                
                popoverToggleButton.popover({
                    html: true, 
                    content: function() {
                        //var content_string = buttonToolbar.html();
                        return buttonToolbar;
                    }
                });

                popoverToggleButton.append(popoverToggleButtonSpan);
                popoverButtonGroup_1.append(popoverToggleButton);
                popoverButtonToolbar.append(popoverButtonGroup_1);
                popoverButtonToolbar.appendTo(parentTd);
            }
        }],
        'drawCallback' : function(settings){}
    });
});
</script>