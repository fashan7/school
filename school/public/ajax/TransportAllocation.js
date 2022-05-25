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
    $("#TrnasportALLReg").validate({
        rules: {
            routecode:{   
                required: true,
            },
            destination:{
                required: true,
            },
            usertype:{
                required: true,
            },
            sFrequency:{
                required: true,
            },
            eFrequency:{
                required: true,
            },
            gradenumberlist:{
                required: true,
            },
            'students[]':{
                required: true,
            },
            Searchemployee:{
                required: true,
            },
            staffid:{
                required: true,
            },
        },
        messages:{            
            routecode:{
                required: "Please Fill the Empty Box",                
            },
            destination:{
                required: "Please Fill the Empty Box",
            },
            usertype:{
                required: "Please Fill the Empty Box",
            },
            sFrequency:{
                required: "Please Fill the Empty Box",
            },
            eFrequency:{
                required: "Please Fill the Empty Box",
            },
            gradenumberlist:{
                required: "Please Fill the Empty Box",
            },
            'students[]':{
                required: "Please Fill the Empty Box",
            },
            Searchemployee:{
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
        var data = $('#TrnasportALLReg').serialize();
        $.ajax({
            url: 'TransportAllocationRegister',
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
                            setTimeout("location.href = 'transportAllocation';",300);
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