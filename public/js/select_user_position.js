$(function(){
    "use strict";
    ////////////////////////////////////////////////////////
    $('#user_position').select2({
        ajax          : {
            url: '{{ url('/') }}',
            data: function (params) {
                var query = {
                    search			: params.term,
                    defect_type		: $('#defect_type').val(),
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
                            text: obj.name || obj.code, 
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
        placeholder	      : 'Search',
        //minimumInputLength: 1,
        multiple		  : false,
        closeOnSelect	  : true,
        escapeMarkup      : function (markup) { return markup; }
    });
    ////////////////////////////////////////////////////////
});