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
    $("#ExambookReg").validate({
        rules: {            
            SearchStudent: {
                required: true
            },
            studentid: {
                required: true
            },
            paperno: {
                required: true
            },
            time1: {
                required: true
            }
        },
        messages:{
            SearchStudent:{
                required: "Please Fill the Empty Box"
            },
            studentid:{
                required: "Please Fill the Empty Box"
            },
            paperno:{
                required: "Please Fill the Empty Box"
            },
            time1:{
                required: "Please Fill the Empty Box"
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
        var data = $('#ExambookReg').serialize();
        $.ajax({
            url: 'exambooking',
            method: 'POST',
            data:data,
            success:function(jsonData){
//                alert(jsonData)
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Booked Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            setTimeout("location.href = 'bookExam';",300);
                        });
                }
                else if(jsonData === "oops")
                {
                    alertify.notify("Already have booked", "error", "3", function(){ console.log('dismissed'); });
                    loading = false;
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