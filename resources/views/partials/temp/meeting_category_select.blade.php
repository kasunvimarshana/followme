<script>
$(function(){
    "use strict";
    $.fn.select2.defaults.set( "theme", "bootstrap" );
    /*$('#id').select2({
        theme: "bootstrap"
    });*/
    
    $('#meeting_category_id').select2({
        cacheDataSource: [],
        placeholder: "Select Type",
        query: function(query) {
            var self = this;
            var key = query.term;
            var cachedData = null;
            
            if( self.cacheDataSource ){
                cachedData = self.cacheDataSource[key];
            }

            if(cachedData) {
                query.callback({results: cachedData.result});
                return;
            } else {
                $.ajax({
                    url: "{!! route('meetingCategory.list') !!}",
                    cache: true,
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
                    dataType: 'json',
                    type: 'GET',
                    success: function(data) {
                        self.cacheDataSource[key] = data;
                        query.callback({results: data.result});
                    }
                })
            }
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
        width: '100%',
        //minimumInputLength: 1,
        multiple		  : false,
        closeOnSelect	  : true,
        allowClear	  : true,
        escapeMarkup      : function (markup) { return markup; }
    });
    
});
</script>