$(document).ready(function (){
    var loading = false;
    $("#login").click(function (event){
        event.preventDefault();
        
        if(loading){
            return ;
        }
        loading = true;
        var username = $("#username").val(), password = $("#password").val();
        if((username == "") || (password == ""))
        {
            $.confirm({
                icon: 'fa fa-exclamation-triangle',
                title: "Caught Empty Fields !",
                content: "You Cannot Poke inside", 
                type: 'red',
                typeAnimated: true,
                buttons: {
                    close: function(){
                        //close
                    }
                }
            });
            loading = false;
        }
        else
        {
            var data = $("#loginForm").serialize();
            $.ajax({
                type: "POST",
                url: "checkLogin",
                data: data,                
                success: function(jsonData){
//                    alert(jsonData);
                    if(jsonData == 'done')
                    {
                        loading = false;
                        $("#hidebutton").hide();
                        $("#showloading").html('<img src="../public/gif/Ripplesmall.gif">');                        
                        setTimeout("location.href = '/';",2000);
                    }
                    else
                    {
                        $.confirm({
                            icon: 'fa fa-exclamation-triangle',
                            title: "Credentials Invalid!",
                            content: "Try again a little bit", 
                            type: 'red',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: "TryAgain",
                                    btnClass: "btn-red",
                                    action: function()
                                    {
                                        $("#username").val("");
                                        $("#password").val("");
                                    }
                                },
                            }
                        });
                        loading = false;
                    }
                },
            });
        }
    });
});