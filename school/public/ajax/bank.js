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
    $("#bankReg").validate({
        rules: {
            bankname: {
                validname: true,
                required: true,
                remote: {
                    url: 'bankValidation',
                    type: 'POST',
                    data: {
                        bankname: function(){
                            return $("#bankname").val();
                        }
                    }
                }
            }
        },
        messages:{
            bankname:{
                required: "Please Fill the Empty Box",
                validname: "Enter a valid name",
                remote: "Bank Name Already Taken"
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
        var data = $('#bankReg').serialize();
        $.ajax({
            url: 'bankRegister',
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
                            $("#bankname").val("");
                            $("#bankname").closest('.form-group').removeClass('has-success');
                            fetch_bank();
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
    
    function fetch_bank()
    {
        $.ajax({
            url: "loadbankDetailsToedit",
            method: "POST",
            success:function(jsonData)
            {
                $('#loadbank').html(jsonData);
            }
        });
    }
});