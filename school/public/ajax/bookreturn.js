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
    $("#BookReturnReg").validate({
        rules: {
            childTbID: {
                required: true
            },
            searchby:{
                required: true
            },
            returnrenewal:{
                required: true,
            },
            returndate:{
              required: true,  
            },
            fineamount: {
                required: true,
                number: true
            },
            remarks: {
                required: true
            },
            duedate: {
                required: true
            },
        },
        messages:{
            searchby:{
                required: "Please Search The Book To Issue and Trigger the Search Button"
            },
            returnrenewal:{
                required: "Please Select The User Type"
            },
            returndate:{
                required: "Please Search Student Name and Select"
            },
            fineamount:{
                required: "This Field is required",
                number: "Numeric only allowed"
            },
            remarks:{
                required: "Please Fill the Empty Box"
            },
            duedate:{
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
        var data = $('#BookReturnReg').serialize();
        $.ajax({
            url: 'updateIssuedBook',
            method: 'POST',
            data:data,
            success:function(jsonData){                
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Book Returned</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebutton").show(); 
                            setTimeout("location.href = 'bookReturn';",450);
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