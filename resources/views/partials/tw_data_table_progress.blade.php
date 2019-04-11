<!-- script>
$(function(){
    "use strict";
    var dataTableUserList = $('#userDataTable').DataTable();
});
</script -->

<script>
var twProgressDataTableCustomData = {};
$(function(){
    "use strict";
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
        'autoWidth' : false,
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
                data.own_user = "{!! $auth_user->mail !!}";
                //data.status_id = null;
                data = $.extend(data, twProgressDataTableCustomData);
            },
            'error' : function(e){
                //console.log(e);
            }
        },
        'rowCallback' : function(row, data, displayNum, displayIndex, dataIndex){
            if( data.status_id == {!! App\Enums\Status::OPEN !!} ){
                $(row).addClass( 'success' );
                $(row).removeClass( 'danger' );
            }else if( data.status_id == {!! App\Enums\Status::CLOSE !!} ){
                $(row).addClass( 'danger' );
                $(row).removeClass( 'success' );
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
                //button_1_body.text('text');
                button_1.bind("click", function(){
                    var url = "{!! route('home.index') !!}";
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
});
</script>