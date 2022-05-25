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
    $("#userregsubmit").validate({
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
            day: {
                required: true
            },
            branchname:{
                required: true,
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
                remote: {
                    url: 'usernameValidation',
                    type: 'POST',
                    data: {
                        username: function(){
                            return $("#username").val();
                        }
                    }
                }
            },
            password: {
                required: true,
                minlength: 5
            },
            usertype: {
                required: true
            },
            gender:{
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
            branchname:{
                required: "Please Fill the Empty Box"
            },
            mobile:{
                required: "Please Fill the Empty Box"
            },
            day:{
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
                required: "Please Fill the Empty Box",
                remote: "Username Name Already Taken"
            },
            password:{
                required: "Please Fill the Empty Box",
                minlength: "Your password must be at least 5 characters long"
            },
            usertype:{
                required: "Please Fill the Empty Box"   
            },
            gender:{
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
        var data = $('#userregsubmit').serialize();
        $.ajax({
            url: 'UserRegisterSubmit',
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
                            $("#fname").val("");
                            $("#lname").val("");
                            $("#mobile").val("");
                            $("#nic").val("");
                            $("#email").val("");
                            $("#address").val("");
                            $("#username").val("");
                            $("#password").val("");
                            $("#usertype").val("");
                            $("#day").val("");
                            $("#month").val("");
                            $("#year").val("");
                            $('#branchname').val("");
                        
                            $("#fname").closest('.form-group').removeClass('has-success');
                            $("#lname").closest('.form-group').removeClass('has-success');
                            $("#mobile").closest('.form-group').removeClass('has-success');
                            $("#nic").closest('.form-group').removeClass('has-success');
                            $("#email").closest('.form-group').removeClass('has-success');
                            $("#address").closest('.form-group').removeClass('has-success');
                            $("#username").closest('.form-group').removeClass('has-success');
                            $("#password").closest('.form-group').removeClass('has-success');
                            $("#usertype").closest('.form-group').removeClass('has-success');
                            $("#day").closest('.form-group').removeClass('has-success');
                            $("#month").closest('.form-group').removeClass('has-success');
                            $("#year").closest('.form-group').removeClass('has-success');
                            $("#branchname").closest('.form-group').removeClass('has-success');
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