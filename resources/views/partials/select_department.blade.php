<script>
$(function(){
    "use strict";
    $.fn.select2.defaults.set( "theme", "bootstrap" );
    /*$('#id').select2({
        theme: "bootstrap"
    });*/
    
    $('#department_id').select2({
        ajax          : {
            url: "{!! route('department.list') !!}",
            // dataType: 'json',
            delay: 250,
            data: function (params) {
                var query = {
                    search			: params.term, // $.trim(params.term)
                    active		    : 1,
                    page  			: params.page || 1,
                    length			: 10
                }
                return query;
            },
            processResults: function (data, params) {
                params.page = params.page || 1;
                return {
                    results: $.map(data.data, function (obj) {
                        return { 
                            id  : obj.id, 
                            text: obj.name || obj.id, 
                            data: obj 
                        };
                    }),
                    pagination: {
                        more: (params.page * data.length) < Number(data.recordsTotal)
                    }
                };
            },
            cache: true
        },
        placeholder	      : 'Select Position',
        //minimumInputLength: 1,
        multiple		  : false,
        closeOnSelect	  : true,
        escapeMarkup      : function (markup) { return markup; }
    });
    
});
</script>