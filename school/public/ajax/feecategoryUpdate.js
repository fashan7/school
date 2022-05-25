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
    
    $("#feecateUpd").validate({
        rules: {
            feecategoryupd: {
                required: true,
                remote: {
                    url: 'feecategoryUpdateValidation',
                    type: 'POST',
                    data: {
                        feecategoryupd: function(){
                            return $("#feecategoryupd").val();
                        },
                        feesid: function(){
                            return $("#feesid").val();
                        }
                    }
                }
            },
            prefixreciptnoupd: {
                required: true,
            },
            descriptionupd: {
                required: true,
            },
        },  
        messages:{
            feecategoryupd:{
                required: "Please Fill the Empty Box",
                remote: "Category Name Already Taken"
            },
            prefixreciptnoupd:{
                required: "Please Fill the Empty Box",
            },
            descriptionupd:{
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
        var data = $('#feecateUpd').serialize();
        $.ajax({
            url: 'feeCategoryUpdate',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Update Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebutton").show(); 
                            setTimeout("location.href = 'FeeCategory';",250);
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