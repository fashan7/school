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
    $("#subCatRegFine").validate({
        rules: {
            feecategory: {
                required: true,
            },
            feesubcategoryname: {
                required: true,
            },
            type: {
                required: true,
            },
            fineamount: {
                required: true,
            },
            finepercentage: {
                required: true,
            },
            finetypestatus: {
                required: true,
            },
            fineincrementin: {
                required: true,
            },
            days: {
                required: true,
            },
            maximumPercentage: {
                required: true,
            },
        },
        messages:{
            feecategory:{
                required: "Please Fill the Empty Box",
            },
            feesubcategoryname:{
                required: "Please Fill the Empty Box",
            },
            type:{
                required: "Please Fill the Empty Box",
            },
            fineamount:{
                required: "Please Fill the Empty Box",
            },
            finepercentage:{
                required: "Please Fill the Empty Box",
            },
            finetypestatus:{
                required: "Please Fill the Empty Box",
            },
            fineincrementin:{
                required: "Please Fill the Empty Box",
            },
            days:{
                required: "Please Fill the Empty Box",
            },
            maximumPercentage:{
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
        var data = $('#subCatRegFine').serialize();
        $.ajax({
            url: 'FineofSubCategoryRegister',
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
                            setTimeout("location.href = 'FeeSubCategoryFine';",300);
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