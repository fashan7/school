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
    $("#UserPrivilageUserTOEdit").validate({
        rules: {
            fname: {
                required: true
            },
            lname: {
                required: true
            },
            mobile: {
                required: true
            },
            dob: {
                required: true
            },
            nic: {
                required: true
            },
            email: {
             required: true,
             validemail: true
            },
            address: {
                required: true
            },
            username: {
                required: true,
            },
            usertype: {
                required: true
            },
        },
        messages:{
            fname:{
                required: "Please Fill the Empty Box"
            },
            lname:{
                required: "Please Fill the Empty Box"
            },
            mobile:{
                required: "Please Fill the Empty Box"
            },
            dob:{
                required: "Please Fill the Empty Box"
            },
            nic:{
                required: "Please Fill the Empty Box"
            },
            email:{
                required: "Please Fill the Empty Box",
                validemail: "Enter Valid Email Address"
            },
            address:{
                required: "Please Fill the Empty Box"
            },
            username:{
                required: "Please Fill the Empty Box"
            },
            usertype:{
                required: "Please Fill the Empty Box"   
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
        var data = $('#UserPrivilageUserTOEdit').serialize();
        $.ajax({
            url: 'UserPrivilageUpdateDetails',
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
                        
                            $("#fname").closest('.form-group').removeClass('has-success');
                            $("#lname").closest('.form-group').removeClass('has-success');
                            $("#mobile").closest('.form-group').removeClass('has-success');
                            $("#dob").closest('.form-group').removeClass('has-success');
                            $("#nic").closest('.form-group').removeClass('has-success');
                            $("#email").closest('.form-group').removeClass('has-success');
                            $("#address").closest('.form-group').removeClass('has-success');
                            $("#username").closest('.form-group').removeClass('has-success');
                            $("#usertype").closest('.form-group').removeClass('has-success');
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