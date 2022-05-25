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
    $("#departmentReg").validate({
        rules: {
            depname: {
                validname: true,
                required: true,
                remote: {
                    url: 'DepartmentValidation',
                    type: 'POST',
                    data: {
                        depname: function(){
                            return $("#depname").val();
                        }
                    }
                }
            }
        },
        messages:{
            depname:{
                required: "Please Fill the Empty Box",
                validname: "Enter a valid name",
                remote: "Department Name Already Taken"
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
        var data = $('#departmentReg').serialize();
        $.ajax({
            url: 'DepartmentRegister',
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
                            $("#depname").val("");
                            $("#depname").closest('.form-group').removeClass('has-success');
                            fetch_dep();
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
    
    function fetch_dep()
    {
        $.ajax({
            url: "loadDepDetailsToedit",
            method: "POST",
            success:function(jsonData)
            {
                $('#loadDep').html(jsonData);
            }
        });
    }
});