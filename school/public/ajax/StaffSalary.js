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
    $("#staffSalarySubmit").validate({
        rules: {
            monthOnly:{
                required: true,
            },
            salaryamount: {
                required: true,
            }
        },
        messages:{
            monthOnly:{
                required: "Please Fill the Empty Box"
            },
            salaryamount:{
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
        var data = $('#staffSalarySubmit').serialize();
        var monthOnly = $('#monthOnly').val();
        var staffid = $('#staffid').val();
        $.ajax({
           url:"monthCheckSalary",
           method:"POST",
           data:{monthOnly:monthOnly, staffid:staffid},
           success:function(jsonData){
               if(jsonData == 'false')
               {
                   alertify.notify("<i>Teacher were paid for this month</i>", "error", "6", function(){ console.log('dismissed'); });
                    loading = false;
               }
               else if(jsonData == 'true')
               {
                   $.ajax({
                    url: 'salaryProcess',
                    method: 'POST',
                    data:data,
                    success:function(jsonData){
                        if(jsonData != 'notok')
                        {
                            loading = false;
                            $("#hidebutton").hide();
                            setTimeout("location.href = 'printSalarySlip?ReciptNo="+jsonData+"';",1000);
                        }
                        else if(jsonData = 'notok')
                        {
                            alertify.notify("Something Went Wrong", "error", "3", function(){ console.log('dismissed'); });
                            loading = false;
                        }
                    }
                });
               }
           }
       }); 
        
    }
});