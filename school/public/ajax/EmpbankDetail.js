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
    $("#EmployeebankReg").validate({
        rules: {
            staffno: {
                required: true
            },
            banknameload:{
                required: true
            },
            branchname:{
                required: true
            },
            accountno:{
                required: true
            },
            bAddress:{
                required: true
            },
        },
        messages:{
            staffno:{
                required: "Please Fill the Empty Box"
            },
            banknameload:{
                required: "Please Fill the Empty Box"
            },
            branchname:{
                required: "Please Fill the Empty Box"
            },
            accountno:{
                required: "Please Fill the Empty Box"
            },
            bAddress:{
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
        var data = $('#EmployeebankReg').serialize();
        $.ajax({
            url: 'EmployeeBankRegister',
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
                            $("#staffno").val("");
                            $("#banknameload").val("");
                            $("#branchname").val("");
                            $("#accountno").val("");
                            $("#bAddress").val("");
                        
                            $("#staffno").closest('.form-group').removeClass('has-success');
                            $("#banknameload").closest('.form-group').removeClass('has-success');
                            $("#branchname").closest('.form-group').removeClass('has-success');
                            $("#accountno").closest('.form-group').removeClass('has-success');
                            $("#bAddress").closest('.form-group').removeClass('has-success');
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