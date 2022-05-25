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
    $("#DestinUpd").validate({
        rules: {
            routecode:{                
                required: true,
            },
            pickupanddrop:{
                required: true,
            },
            stoptime:{
                required: true,
            },
            amount:{
                required: true,
                number: true
            },
        },
        messages:{            
            routecode:{
                required: "Please Fill the Empty Box",                
            },
            pickupanddrop:{
                required: "Please Fill the Empty Box",                
            },
            stoptime:{
                required: "Please Fill the Empty Box",
            },
            amount:{
                required: "Please Fill the Empty Box",
                number: "Only Numeric Allow",
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
        var data = $('#DestinUpd').serialize();
        $.ajax({
            url: 'VehicleeDestinationUpd',
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
                            setTimeout("location.href = 'addDestination';",0);
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