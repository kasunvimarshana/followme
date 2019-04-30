<script>
bootbox.dialog({show: false})
    .off("shown.bs.modal")
    .on("shown.bs.modal", function() {
        $("#myInput").focus();
    })
    .modal("show");
</script>
<script>
dialog.on("shown.bs.modal", function() {
    dialog.find(".btn-primary:first").focus();
});
</script>
<script>
function bootbox_confirm(msg, callback_success, callback_cancel) {
    var d = bootbox.confirm({message:msg, show:false, callback:function(result) {
        if (result)
        callback_success();
        else if(typeof(callback_cancel) == 'function')
        callback_cancel();
    }});

    d.on("show.bs.modal", function() {
        //css afjustment for confirm dialogs
        alert("before show");
    });
    return d;
}
</script>