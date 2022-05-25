$(document).ready(function(){
    var loading = false;     
    if(loading){
        return;
    }
    loading = true;
//   alert('1');
    $.ajax({
        url: "AddNewPrivilagePage",
        method: "POST",
        data: {user:'user', id: 'id', sign: 'sign'},
        success: function(jsonData)
        {
            alert(jsonData);
            loading = false;
        }
    });
});