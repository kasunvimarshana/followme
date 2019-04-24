<!-- script>
$(function(){
    "use strict";
    var dataTableUserList = $('#userDataTable').DataTable();
});
</script -->

<script>
//var twDataTableCustomData = {};
$(function(){
    "use strict";
    //$.fn.dataTable.ext.errMode = 'none';
    //$.fn.dataTableExt.errMode = 'ignore';
    $.fn.dataTableExt.sErrMode = "console";
    var dataTableTWList = $('#twDataTable').DataTable({
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
            'title' : '3W',
            'orderable' : false,
            'data' : 'title',
            'render' : function(data, type, row){
                return data;
            }
        },{
            'title' : 'Description',
            'orderable' : false,
            'data' : 'description',
            'render' : function(data, type, row){
                return data;
            }
        },{
            'title' : 'Start Date',
            'orderable' : false,
            'data' : 'start_date',
            'render' : function(data, type, row){
                var date = moment(data, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
                return date;
            }
        },{
            'title' : 'Due Date',
            'orderable' : false,
            'data' : 'due_date',
            'render' : function(data, type, row){
                var date = moment(data, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
                return date;
            }
        },{
            'title' : 'Owners',
            'orderable' : false,
            'data' : 'tw_users',
            'render' : function(data, type, row){
                var data_str = '';
                if(($.isArray(data))){
                    $.each(data, function( key, value ){
                        data_str =  value.own_user + ' <br/> ' + data_str;
                    });
                }else{
                    data_str = value.own_user;
                }
                
                return data_str;
            }
        },{
            'title' : 'Status',
            'orderable' : false,
            'data' : null,
            'render' : function(data, type, row){
                var data_str = '';
                var is_done = data.is_done;
                //var due_date = moment(data.due_date, 'YYYY-MM-DD HH:mm:ss').toDate();
                var due_date = moment(data.due_date, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
                var today = moment().format('YYYY-MM-DD');
                // pass
                if( (is_done == true) ){
                   if( (moment(due_date).isAfter(today)) || (moment(due_date).isBefore(today)) || (moment(due_date).isSame(today)) ){
                      data_str = 'Done';
                    }
                }
                // fail
                if( (is_done == false) || (is_done == null) ){
                   if( (moment(due_date).isBefore(today)) ){
                      data_str = 'Fail';
                    }
                }
                // inprogress
                if( (is_done == false) || (is_done == null) ){
                   if( (moment(due_date).isAfter(today)) || (moment(due_date).isSame(today)) ){
                      data_str = 'Inprogress';
                    }
                }
                
                return data_str;
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
            'url' : "{!! route('tw.list') !!}",
            'cache' : true,
            'dataSrc' : 'data',
            'type' : 'GET',
            'deferRender' : true,
            //'dataType' : 'json',
            'delay' : 300,
            'data' : function(data){
                //console.log(data);
                var tableObj = $('#twDataTable');
                var tableObjData = {};
                var tableObjDataTemp = tableObj.data();
                tableObj.removeData();
                data.own_user = "{!! $auth_user->mail !!}";
                if( tableObjDataTemp.hasOwnProperty('status_id') ){
                    tableObjData.progress = tableObjDataTemp.status_id;
                    tableObjData.due_date_from = tableObjDataTemp.start_date;
                    tableObjData.due_date_to = tableObjDataTemp.due_date;
                }else{
                    tableObjData.start_date = tableObjDataTemp.start_date;
                    tableObjData.due_date = tableObjDataTemp.due_date;
                }
                if( tableObjDataTemp.hasOwnProperty('created_user') ){
                    tableObjData.created_user = tableObjDataTemp.created_user;
                }
                if( tableObjDataTemp.hasOwnProperty('meeting_category_id') ){
                    tableObjData.meeting_category_id = tableObjDataTemp.meeting_category_id;
                }
                if( tableObjDataTemp.hasOwnProperty('title') ){
                    tableObjData.search = tableObjDataTemp.title;
                }
                data = $.extend(data, tableObjData);
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
                buttonToolbar.addClass('btn-toolbar pull-right');
                
                //button group
                var buttonGroup_3 = $('<div></div>');
                buttonGroup_3.addClass('btn-group');
                var button_3 = $('<button></button>');
                button_3.addClass('btn btn-success');
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
                    var url = "{!! route('tw.show', ['#tW']) !!}";
                    url = url.replace("#tW", rowData.id);
                    $( location ).attr("href", url);
                });
                button_3.append(button_3_body);
                buttonGroup_3.append(button_3);
                
                //button group
                var buttonGroup_4 = $('<div></div>');
                buttonGroup_4.addClass('btn-group');
                var button_4 = $('<button></button>');
                button_4.addClass('btn btn-warning');
                var button_4_body = $('<i></i>');
                button_4_body.addClass('fa fa-book');
                button_4_body.attr('data-toggle', 'tooltip');
                button_4_body.attr('data-placement', 'auto');
                button_4_body.attr('data-container', 'body');
                //button_4_body.attr('title', 'title');
                button_4_body.attr('data-title', 'Update Attachment');
                //button_4_body.attr('data-content', 'content');
                button_4_body.tooltip();
                button_4.bind("click", function(){
                    var url = "{!! route('twInfo.create', ['#tW']) !!}";
                    url = url.replace("#tW", rowData.id);
                    $( location ).attr("href", url);
                });
                button_4.append(button_4_body);
                buttonGroup_4.append(button_4);
                
                //button group
                var buttonGroup_5 = $('<div></div>');
                buttonGroup_5.addClass('btn-group');
                var button_5 = $('<button></button>');
                button_5.addClass('btn btn-info');
                var button_5_body = $('<i></i>');
                button_5_body.addClass('fa fa-clipboard');
                button_5_body.attr('data-toggle', 'tooltip');
                button_5_body.attr('data-placement', 'auto');
                button_5_body.attr('data-container', 'body');
                //button_5_body.attr('title', 'title');
                button_5_body.attr('data-title', 'Update Status');
                //button_5_body.attr('data-content', 'content');
                button_5_body.tooltip();
                button_5.bind("click", function(){
                    button_5.attr("disabled", true);
                    bootbox.confirm({
                        message: "please confirm",
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
                                var url = "{!! route('tw.changeDoneTrue', ['#tW']) !!}";
                                url = url.replace("#tW", rowData.id);
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
                                    $('#twDataTable').DataTable().ajax.reload( null, false ); // user paging is not reset on reload
                                })
                                .fail(function() {
                                    //console.log( "error" );
                                    alert('fail');
                                })
                                .always(function() {
                                    //console.log( "finished" );
                                    button_5.attr("disabled", false);
                                });
                                
                            }else{
                                button_5.attr("disabled", false);
                            }
                        }
                    });
                    
                })
                button_5.append(button_5_body);
                buttonGroup_5.append(button_5);
                
                buttonToolbar.append(buttonGroup_3);
                buttonToolbar.append(buttonGroup_4);
                if( !rowData.is_done ){
                    buttonToolbar.append(buttonGroup_5);
                }
                buttonToolbar.appendTo(parentTd);
            }
        }],
        'drawCallback' : function(settings){}
    });
});
</script>