$(document).ready(function(){
    var loading = false;     
    if(loading){
        return;
    }
    loading = true;
   var data = $('#IDOFPRIVILAGE').serialize();
    $.ajax({
        url: "UpdatePrivilagePage",
        method: "POST",
        data: data,
        success: function(jsonData)
        {
            loading = false;
        }
    });
});