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
    $("#hostelUpdReg").validate({
        rules: {
            hosteltypeupd: {
                required: true,
            },
            hostelnameupd: {
                required: true,
            },
            hosteladdrupd: {
                required: true,
            },
            hostelpnoupd: {
                required: true,
            },
            wardennameupd: {
                required: true,
            },
            wardenaddrupd: {
                required: true,
            },
            wardenpnoupd: {
                required: true,
            },
        },
        messages:{
            hosteltypeupd:{
                required: "Please Fill the Empty Box"
            },
            hostelnameupd:{
                required: "Please Fill the Empty Box"
            },
            hosteladdrupd:{
                required: "Please Fill the Empty Box"
            },
            hostelpnoupd:{
                required: "Please Fill the Empty Box"
            },
            wardennameupd:{
                required: "Please Fill the Empty Box"
            },
            wardenaddrupd:{
                required: "Please Fill the Empty Box"
            },
            wardenpnoupd:{
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
        var data = $('#hostelUpdReg').serialize();
        $.ajax({
            url: 'hostelUpdate',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebuttonss").hide();
                    alertify.notify("<i><b>Updated Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebuttonss").show(); 
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