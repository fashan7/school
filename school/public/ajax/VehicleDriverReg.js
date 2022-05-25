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
    $("#VehicledriverReg").validate({
        rules: {
            vehicle:{                
                required: true,
            },
            drivername:{
                required: true,
            },
            caddress:{
                required: true,
            },
            paddress:{
                required: true,
            },
            dob:{
                required: true,
            },
            Phone:{
                required: true,
                number:true
            },
            license:{
                required: true,
            },
        },
        messages:{            
            vehicle:{
                required: "Please Fill the Empty Box",                
            },
            drivername:{
                required: "Please Fill the Empty Box",
            },
            caddress:{
                required: "Please Fill the Empty Box",
            },
            paddress:{
                required: "Please Fill the Empty Box",
            },
            dob:{
                required: "Please Fill the Empty Box",
            },
            Phone:{
                required: "Please Fill the Empty Box",
                number: "Only Numbers Allow"
            },
            license:{
                required: "Please Fill the Empty Box",
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
        var data = $('#VehicledriverReg').serialize();
        $.ajax({
            url: 'VehicleeDriverRegister',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Saved Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebutton").show(); 
                            setTimeout("location.href = 'addDriver';",300);
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