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
    $("#hostelReg").validate({
        rules: {
            hosteltype: {
                required: true,
            },
            hostelname: {
                required: true,
            },
            hosteladdr: {
                required: true,
            },
            hostelpno: {
                required: true,
            },
            wardenname: {
                required: true,
            },
            wardenaddr: {
                required: true,
            },
            wardenpno: {
                required: true,
            },
        },
        messages:{
            hosteltype:{
                required: "Please Fill the Empty Box"
            },
            hostelname:{
                required: "Please Fill the Empty Box"
            },
            hosteladdr:{
                required: "Please Fill the Empty Box"
            },
            hostelpno:{
                required: "Please Fill the Empty Box"
            },
            wardenname:{
                required: "Please Fill the Empty Box"
            },
            wardenaddr:{
                required: "Please Fill the Empty Box"
            },
            wardenpno:{
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
        var data = $('#hostelReg').serialize();
        $.ajax({
            url: 'hostelRegister',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebuttonsave").hide();
                    alertify.notify("<i><b>Saved Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebuttonsave").show(); 
                            setTimeout("location.href = 'hostelDetails';",350);
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