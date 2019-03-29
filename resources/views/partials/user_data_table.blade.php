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
            'data' : null,
            'defaultContent' : '',
            'render' : function(data, type, row){
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
                return data;
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
            'searchable' : false,
            'data' : 'department',
            'render' : function(data, type, row){
                console.log(data);
                var department = data || {};
                var departmentName = department.name || '';
                /*return data;*/
                return '';
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
                console.log(data);
            },
            'error' : function(e){
                //console.log(e);
            }
        },
        'rowCallback' : function(row, data, displayNum, displayIndex, dataIndex){},
        'createRow' : function(row, data, dataIndex){},
        'columnDefs' : [],
        'drawCallback' : function(settings){}
    });
});
</script>