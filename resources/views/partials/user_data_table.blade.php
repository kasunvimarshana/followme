<!-- script>
$(function(){
    "use strict";
    var dataTableUserList = $('#userDataTable').DataTable();
});
</script -->

<script>
$(function(){
    "use strict";
    var dataTableUserList = $('#userDataTable').DataTable({
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
            'title' : 'Email',
            'orderable' : false,
            'data' : 'email',
            'render' : function(data, type, row){
                return data;
            }
        },{
            'title' : 'EPF-No',
            'orderable' : false,
            'data' : 'epf_no',
            'render' : function(data, type, row){
                return String(data).padStart(4, '0');
            }
        },{
            'title' : 'Name',
            'orderable' : false,
            'data' : 'name',
            'render' : function(data, type, row){
                return data;
            }
        },{
            'title' : 'Phone',
            'orderable' : false,
            'data' : 'phone',
            'render' : function(data, type, row){
                return data;
            }
        },{
            'title' : 'Department',
            'orderable' : false,
            'data' : 'department',
            'render' : function(data, type, row){
                var department = data || {};
                var departmentName = department.name || '';
                return departmentName;
            }
        },{
            'title' : 'Position',
            'orderable' : false,
            'data' : 'user_position',
            'render' : function(data, type, row){
                var userPosition = data || {};
                var userPositionName = userPosition.name || '';
                return userPositionName;
            }
        },{
            'title' : '',
            'orderable' : false,
            'className' : 'center',
            'data' : 'id',
            'render' : function(data, type, row){
                return data;
            }
        }],
        'responsive' : true,
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
        'ajax' : {
            'url' : "{!! route('user.list') !!}",
            'dataSrc' : 'data',
            'type' : 'GET',
            'deferRender' : true,
            //'dataType' : 'json',
            'delay' : 300,
            'data' : function(data){
                data.name = $('#name').val();
                data.email = $('#email').val();
                data.epf_no = $('#epf_no').val();
                data.phone = $('#phone').val();
                data.user_position_id = $('#user_position_id').val();
                data.department_id = $('#department_id').val();
                //console.log(data);
            },
            'error' : function(e){
                //console.log(e);
            }
        },
        'rowCallback' : function(row, data, displayNum, displayIndex, dataIndex){},
        'createRow' : function(row, data, dataIndex){},
        'columnDefs' : [{
            'targets' : -1,
            'createdCell' : function(td, cellData, rowData, row, col){
                var parentTd = $(td);
                parentTd.empty();
                
                var buttonToolbar = $('<div></div>');
                buttonToolbar.addClass('btn-toolbar');
                //button group
                var buttonGroup_1 = $('<div></div>');
                buttonGroup_1.addClass('btn-group');
                var button_1 = $('<button></button>');
                button_1.addClass('btn btn-info');
                var button_1_body = $('<i></i>');
                button_1_body.addClass('fa fa-edit');
                //button_1_body.text('text');
                //button1.bind("click", function(){});
                button_1.append(button_1_body);
                buttonGroup_1.append(button_1);
                
                //button group
                var buttonGroup_2 = $('<div></div>');
                buttonGroup_2.addClass('btn-group');
                var button_2 = $('<button></button>');
                button_2.addClass('btn btn-danger');
                var button_2_body = $('<i></i>');
                button_2_body.addClass('fa fa-trash-o');
                button_2.append(button_2_body);
                buttonGroup_2.append(button_2);
                
                
                buttonToolbar.append(buttonGroup_1);
                buttonToolbar.append(buttonGroup_2);
                buttonToolbar.appendTo(parentTd);
            }
        }],
        'drawCallback' : function(settings){}
    });
});
</script>