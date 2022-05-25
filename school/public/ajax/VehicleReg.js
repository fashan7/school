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
    $("#VehicleReg").validate({
        rules: {
            vehicleno1:{                
                required: true,
            },
            vehicleno2: {
                required: true,
                number:true,
                remote: {
                    url: 'vehicleValidation',
                    type: 'POST',
                    data: {
                        vehicleno1: function(){
                            return $("#vehicleno1").val();
                        },
                        vehicleno2: function(){
                            return $("#vehicleno2").val();
                        }
                    }
                }
            },
            noofseats:{
                required: true,
                number:true,
            },
            maximumallowed:{
                required: true,
                number:true,
            },
            vehicletype:{
                required: true,
            },
            contactperson:{
                required: true,
            },
            insurancerenewal:{
                required: true,
            },
            trackid:{
                required: true,
            },
        },
        messages:{            
            vehicleno1:{
                required: "Please Fill the Empty Box",                
            },
            vehicleno2:{
                required: "Please Fill the Empty Box",
                number: "Only Numeric Allow",
                remote: "This Vehicle No Is Already Registered"
            },
            noofseats:{
                required: "Please Fill the Empty Box",
                number: "Only Numeric Allow"
            },
            maximumallowed:{
                required: "Please Fill the Empty Box",
                number: "Only Numeric Allow"
            },
            vehicletype:{
                required: "Please Fill the Empty Box",
            },
            contactperson:{
                required: "Please Fill the Empty Box",
            },
            insurancerenewal:{
                required: "Please Fill the Empty Box",
            },
            trackid:{
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
        var data = $('#VehicleReg').serialize();
        $.ajax({
            url: 'VehicleeRegister',
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
                            setTimeout("location.href = 'addVehicle';",300);
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