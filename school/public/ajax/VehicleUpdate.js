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
    $("#VehicleUpd").validate({
        rules: {
            vehicleno1Upd:{                
                required: true,
            },
            vehicleno2Upd: {
                required: true,
                number:true,
                remote: {
                    url: 'vehicleValidationUpdate',
                    type: 'POST',
                    data: {
                        vehicleid: function(){
                            return $("#vehicleid").val();
                        },
                        vehicleno1Upd: function(){
                            return $("#vehicleno1Upd").val();
                        },
                        vehicleno2Upd: function(){
                            return $("#vehicleno2Upd").val();
                        }
                    }
                }
            },
            noofseatsUpd:{
                required: true,
                number:true,
            },
            maximumallowedUpd:{
                required: true,
                number:true,
            },
            vehicletypeUpd:{
                required: true,
            },
            contactpersonUpd:{
                required: true,
            },
            insurancerenewalUpd:{
                required: true,
            },
            trackidUpd:{
                required: true,
            },
        },
        messages:{            
            vehicleno1Upd:{
                required: "Please Fill the Empty Box",                
            },
            vehicleno2Upd:{
                required: "Please Fill the Empty Box",
                number: "Only Numeric Allow",
                remote: "This Vehicle No Is Already Registered"
            },
            noofseatsUpd:{
                required: "Please Fill the Empty Box",
                number: "Only Numeric Allow"
            },
            maximumallowedUpd:{
                required: "Please Fill the Empty Box",
                number: "Only Numeric Allow"
            },
            vehicletypeUpd:{
                required: "Please Fill the Empty Box",
            },
            contactpersonUpd:{
                required: "Please Fill the Empty Box",
            },
            insurancerenewalUpd:{
                required: "Please Fill the Empty Box",
            },
            trackidUpd:{
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
        var data = $('#VehicleUpd').serialize();
        $.ajax({
            url: 'VehicleeUpdate',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebuttons").hide();
                    alertify.notify("<i><b>Updated Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebuttons").show(); 
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