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
    $("#leaveReg").validate({
        rules: {
            leaveCat: {
                validname: true,
                required: true,
                remote: {
                    url: 'LeaveCategoryValidation',
                    type: 'POST',
                    data: {
                        leaveCat: function(){
                            return $("#leaveCat").val();
                        }
                    }
                }
            }
        },
        messages:{
            leaveCat:{
                required: "Please Fill the Empty Box",
                validname: "Enter a valid name",
                remote: "Category Name Already Taken"
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
        var data = $('#leaveReg').serialize();
        $.ajax({
            url: 'LeaveCategoryRegister',
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
                            $("#leaveCat").val("");
                            $("#leaveCat").closest('.form-group').removeClass('has-success');
                            fetch_category();
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
    
    function fetch_category()
    {
        $.ajax({
            url: "loadCategoryDetailsToedit",
            method: "POST",
            success:function(jsonData)
            {
                $('#loadCatnames').html(jsonData);
            }
        });
    }
});