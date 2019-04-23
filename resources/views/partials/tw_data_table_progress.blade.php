<!-- script>
$(function(){
    "use strict";
    var dataTableUserList = $('#userDataTable').DataTable();
});
</script -->

<script>
//var twProgressDataTableCustomData = {};
$(function(){
    "use strict";
    //$.fn.dataTable.ext.errMode = 'none';
    //$.fn.dataTableExt.errMode = 'ignore';
    $.fn.dataTableExt.sErrMode = "console";
    var dataTableTWList = $('#twProgressDataTable').DataTable({
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
            'title' : 'Title',
            'orderable' : false,
            'data' : 'title',
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
        'searching' : false,
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
            'delay' : 250,
            'data' : function(data){
                //console.log(data);
                var tableObj = $('#twProgressDataTable');
                var tableObjData = {};
                var tableObjDataTemp = tableObj.data();
                data.own_user = "{!! $auth_user->mail !!}";
                if( tableObjDataTemp.hasOwnProperty('status_id') ){
                    tableObjData.progress = tableObjDataTemp.status_id;
                    tableObjData.progress_due_date_from = moment().subtract(5, 'M').format('YYYY-MM-DD');
                    tableObjData.progress_due_date_to = moment().format('YYYY-MM-DD');
                }
                data = $.extend(data, tableObjData);
            },
            'error' : function(e){
                //console.log(e);
            }
        },
        'rowCallback' : function(row, data, displayNum, displayIndex, dataIndex){
            var tableObj = $('#twProgressDataTable');
            var status_label = tableObj.data('status_id');
            
            if( status_label == {!! App\Enums\TWStatusEnum::COMPLETED !!} ){
                $(row).addClass( 'bg-green' );
                $(row).removeClass( 'bg-red' );
                $(row).removeClass( 'bg-yellow' );
            }else if( status_label == {!! App\Enums\TWStatusEnum::FAIL !!} ){
                $(row).addClass( 'bg-red' );
                $(row).removeClass( 'bg-green' );
                $(row).removeClass( 'bg-yellow' );
            }else if( status_label == {!! App\Enums\TWStatusEnum::INPROGRESS !!} ){
                $(row).addClass( 'bg-yellow' );
                $(row).removeClass( 'bg-green' );
                $(row).removeClass( 'bg-red' );
            }else{
                $(row).removeClass( 'bg-green' );
                $(row).removeClass( 'bg-red' );
                $(row).removeClass( 'bg-yellow' );
            }
        },
        'createRow' : function(row, data, dataIndex){},
        //'order' : [[1, 'asc']],
        'columnDefs' : [{
            'targets' : [0],
            'responsivePriorty' : 0
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
                var buttonGroup_1 = $('<div></div>');
                buttonGroup_1.addClass('btn-group');
                var button_1 = $('<button></button>');
                button_1.addClass('btn btn-success');
                var button_1_body = $('<i></i>');
                button_1_body.addClass('fa fa-eye');
                /////////////////////////////////////
                button_3_body.attr('data-toggle', 'tooltip');
                button_3_body.attr('data-placement', 'auto');
                button_3_body.attr('data-container', 'body');
                //button_3_body.attr('title', 'title');
                button_3_body.attr('data-title', 'View');
                //button_3_body.attr('data-content', 'content');
                button_3_body.tooltip();
                /////////////////////////////////////
                button_1_body.attr('data-toggle', 'tooltip');
                button_1_body.attr('data-placement', 'top');
                button_1_body.attr('data-container', 'body');
                button_1_body.attr('title', 'view');
                //button_1_body.tooltip({container: '.btn'});
                button_1.tooltip();
                //button_1_body.text('text');
                button_1.bind("click", function(){
                    var url = "{!! route('tw.show', ['#tW']) !!}";
                    url = url.replace("#tW", rowData.id);
                    $( location ).attr("href", url);
                });
                button_1.append(button_1_body);
                buttonGroup_1.append(button_1);
                
                buttonToolbar.append(buttonGroup_1);
                buttonToolbar.appendTo(parentTd);
            }
        }],
        'drawCallback' : function(settings){}
    });
    
    $('#twProgressDataTable').parents('div.dataTables_wrapper').first().hide();
});
</script>