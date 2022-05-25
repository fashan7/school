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
    $("#IssuebooksReg").validate({
        rules: {
            childTbID: {
                required: true
            },
            searchby:{
                required: true
            },
            SearchStudent:{
                required: true,
            },
            Searchemployee:{
              required: true,  
            },
            usertype: {
                required: true
            },
            studentid: {
                required: true
            },
            staffid: {
                required: true
            },
            bookissuedate: {
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
            usertype:{
                required: "Please Select The User Type"
            },
            SearchStudent:{
                required: "Please Search Student Name and Select"
            },
            Searchemployee:{
                required: "Please Search Staff Name and Select"
            },
            bookissuedate:{
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
        var data = $('#IssuebooksReg').serialize();
        $.ajax({
            url: 'issueBookRegister',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Book Issued</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebutton").show(); 
                            setTimeout("location.href = 'issueBooks';",450);
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