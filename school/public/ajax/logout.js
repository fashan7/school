$(document).ready(function() {
    $("#signout").click(function(){
        $.confirm({
            title: 'Logout?',
            content: 'Your time is out, you will be automatically logged out in 10 seconds.',
            autoClose: 'logoutUser|10000',
            buttons:{
                logoutUser: {
                    text: 'Logout Myself',
                    action: function(){
                        var signout = $("#signout").val();
                        $.ajax({
                            url: "logout",
                            success: function(jsonData){
                                if(jsonData == 'signout')
                                {
                                    setTimeout("location.href = '/login';",400);
                                }
                            }
                        });
                    }
                },
                cancel: function(){                   
                    $.alert({
                        title: 'Cancelled!',
                        content: 'LogOut to Prevent From Unauthorized Access!',
                        type: 'dark',
                    });
                }
            },
        });
    });
});