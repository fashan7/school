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
    $("#VehicledriverUpd").validate({
        rules: {
            vehicleUpd:{                
                required: true,
            },
            drivernameUpd:{
                required: true,
            },
            caddressUpd:{
                required: true,
            },
            paddressUpd:{
                required: true,
            },
            dobUpd:{
                required: true,
            },
            PhoneUpd:{
                required: true,
                number:true
            },
            licenseUpd:{
                required: true,
            },
        },
        messages:{            
            vehicleUpd:{
                required: "Please Fill the Empty Box",                
            },
            drivernameUpd:{
                required: "Please Fill the Empty Box",
            },
            caddressUpd:{
                required: "Please Fill the Empty Box",
            },
            paddressUpd:{
                required: "Please Fill the Empty Box",
            },
            dobUpd:{
                required: "Please Fill the Empty Box",
            },
            PhoneUpd:{
                required: "Please Fill the Empty Box",
                number: "Only Numbers Allow"
            },
            licenseUpd:{
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
        var data = $('#VehicledriverUpd').serialize();
        $.ajax({
            url: 'VehicleeDriverUpdate',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebuttons").hide();
                    alertify.notify("<i><b>Update Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebuttons").show(); 
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