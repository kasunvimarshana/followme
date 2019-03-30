<script>
$(function(){
    "use strict";
    var dataTableDepartmentList = $('#departmentDataTable').DataTable({
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
            'title' : 'Name',
            'orderable' : false,
            'data' : 'name',
            'render' : function(data, type, row){
                return 'controls';
            }
        },{
            'title' : '',
            'orderable' : false,
            'className' : 'center',
            'data' : null,
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
            'url' : "{!! route('department.list') !!}",
            'dataSrc' : 'data',
            'type' : 'GET',
            'deferRender' : true,
            //'dataType' : 'json',
            'delay' : 300,
            'data' : function(data){
                var name = $('#name').val();
                data.search = name || data.search;
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
                buttonToolbar.addClass('btn-toolbar pull-right');
                //button group
                var buttonGroup_1 = $('<div></div>');
                buttonGroup_1.addClass('btn-group');
                var button_1 = $('<button></button>');
                button_1.addClass('btn btn-info');
                var button_1_body = $('<i></i>');
                button_1_body.addClass('fa fa-edit');
                //button_1_body.text('text');
                button_1.bind("click", function(){
                    var url = "{!! route('department.edit', ['#departmentIdParam']) !!}";
                    url = url.replace("#departmentIdParam", rowData.id);
                    $( location ).attr("href", url);
                });
                button_1.append(button_1_body);
                buttonGroup_1.append(button_1);
                
                //button group
                var buttonGroup_2 = $('<div></div>');
                buttonGroup_2.addClass('btn-group');
                var button_2 = $('<button></button>');
                button_2.addClass('btn btn-danger');
                var button_2_body = $('<i></i>');
                button_2_body.addClass('fa fa-trash-o');
                button_2.bind("click", function(){
                    
                    bootbox.confirm({
                        message: "are you sure tht you want to delete <strong>" + rowData.name + "</strong>",
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
                                var url = "{!! route('department.destroy', ['#departmentIdParam']) !!}";
                                url = url.replace("#departmentIdParam", rowData.id);
                                $( location ).attr("href", url);
                            }
                        }
                    });
                    
                })
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