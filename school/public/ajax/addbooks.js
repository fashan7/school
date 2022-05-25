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
    $("#addbooksReg").validate({
        rules: {
            billno: {
                required: true,
            },
            bookno: {
                required: true,
                remote: {
                    url: 'BooknoValidation',
                    type: 'POST',
                    data: {
                        bookno: function(){
                            return $("#bookno").val();
                        },
                        isbnno: function(){
                            return $("#isbnno").val();
                        },
                    }
                }
            },
            title: {
                required: true,
            },
            bookcategory: {
                required: true,
            },
            noofcopies: {
                required: true,
            },
            publisher: {
                required: true,
            },
            bookcost: {
                required: true,
            },
            language: {
                required: true,
            },
            bookconition: {
                required: true,
            },
        },
        messages:{
            billno:{
                required: "Please Fill the Empty Box",
            },
            bookno:{
                required: "Please Fill the Empty Box",
                remote: "Book No Already Taken"
            },
            title:{
                required: "Please Fill the Empty Box",
            },
            bookcategory:{
                required: "Please Fill the Empty Box",
            },
            noofcopies:{
                required: "Please Fill the Empty Box",
            },
            publisher:{
                required: "Please Fill the Empty Box",
            },
            bookcost:{
                required: "Please Fill the Empty Box",
            },
            language:{
                required: "Please Fill the Empty Box",
            },
            bookconition:{
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
        var data = $('#addbooksReg').serialize();
        $.ajax({
            url: 'AddBooksRegister',
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
                            $("#purchasedate").val("");
                            $("#purchasedate").closest('.form-group').removeClass('has-success');
                            $("#billno").val("");
                            $("#billno").closest('.form-group').removeClass('has-success');
                            $("#isbnno").val("");
                            $("#isbnno").closest('.form-group').removeClass('has-success');
                            $("#bookno").val("");
                            $("#bookno").closest('.form-group').removeClass('has-success');
                            $("#title").val("");
                            $("#title").closest('.form-group').removeClass('has-success');
                            $("#author").val("");
                            $("#author").closest('.form-group').removeClass('has-success');
                            $("#edition").val("");
                            $("#edition").closest('.form-group').removeClass('has-success');
                            $("#noofcopies").val("");
                            $("#noofcopies").closest('.form-group').removeClass('has-success');
                            $("#publisher").val("");
                            $("#publisher").closest('.form-group').removeClass('has-success');
                            $("#shelfno").val("");
                            $("#shelfno").closest('.form-group').removeClass('has-success');
                            $("#bookposition").val("");
                            $("#bookposition").closest('.form-group').removeClass('has-success');
                            $("#bookcost").val("");
                            $("#bookcost").closest('.form-group').removeClass('has-success');
                            $("#language").val("");
                            $("#language").closest('.form-group').removeClass('has-success');
                            $("#bookconition").val("");
                            $("#bookconition").closest('.form-group').removeClass('has-success');
                            $("#bookcategory").val("");
                            $("#bookcategory").closest('.form-group').removeClass('has-success');
                            setTimeout("location.href = 'AddBooks';",450);
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