$(document).ready(function(){
    var loading = false;     
    if(loading){
        return;
    }
    loading = true;
    var nameregex = /^[a-zA-Z ]+$/;
    $.validator.addMethod("validname", function(value, element){
       return this.optional( element ) || nameregex.test( value );
    });
        
    var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    $.validator.addMethod("validemail", function(value, element){
        return this.optional(element) || eregex.test(value);
    }); 
    $("#passwordChangeSubmit").validate({
        rules: {
            username: {
                required: true
            },
            cpassword: {
                required: true,
                remote: {
                    url: 'passwordValidation',
                    type: 'POST',
                    data: {
                        cpassword: function(){
                            return $("#cpassword").val();
                        }
                    }
                }
            },
            npassword: {
                required: true,
                minlength: 5
            },
            conpassword: {
                required: true,
                equalTo : "#npassword"
            },
        },
        messages:{            
            username:{
                required: "Please Fill the Empty Box",                
            },
            cpassword:{
                required: "Please Fill the Empty Box",
                remote: "This is not your password!"
            },
            npassword:{
                required: "Please Fill the Empty Box",
                minlength: "Your password must be at least 5 characters long"
            },
            conpassword:{
                required: "Please Fill the Empty Box",
                equalTo: "Password is Not Matched"
            }
        },
        errorPlacement : function(error, element) {
            $(element).closest('.form-group').find('.help-block').html(error.html());
        },
		highlight : function(element) {
		  $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
		unhighlight: function(element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
			$(element).closest('.form-group').find('.help-block').html('');
        },
        submitHandler: function(form){
            $("#hidebutton").hide();
            ajaxSaving();
            loading = false; 
        }
    });
    
    function ajaxSaving()
    {
        var data = $('#passwordChangeSubmit').serialize();
        $.ajax({
            url: 'UserRegUpdatePassword',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Update Successfully</b></i>", "success", "3", 
                        function()
                        { 
                                              
                            console.log('dismissed'); 
                            $("#hidebutton").show();
                            $("#cpassword").val("");
                            $("#npassword").val("");
                            $("#conpassword").val("");
                            
                        
                            $("#username").closest('.form-group').removeClass('has-success');
                            $("#cpassword").closest('.form-group').removeClass('has-success');
                            $("#npassword").closest('.form-group').removeClass('has-success');
                            $("#conpassword").closest('.form-group').removeClass('has-success');
                        });
                }
                else
                {
                    alertify.notify("Something Went Wrong", "error", "3", function(){ console.log('dismissed'); });
                    loading = false;
                }
            }
        });
    }
});