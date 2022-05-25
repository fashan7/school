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
    $("#composeReg").validate({
        rules: {
            herodemo: {
                required: true
            },
            subject: {
                required: true
            },
            composetextarea: {
                required: true
            }
        },
        messages:{
            herodemo:{
                required: "Please Fill the Empty Box"
            },
            subject:{
                required: "Please Fill the Empty Box"
            },
            composetextarea:{
                required: "Please Fill the Empty Box"
            },
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
        var data = $('#composeReg').serialize();
        $.ajax({
            url: 'composemaild',
            method: 'POST',
            data:data,
            success:function(jsonData){
//                alert(jsonData);
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Mail Sent Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebutton").show(); 
                        });
                        setTimeout("location.href = 'mail';", 1000);
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