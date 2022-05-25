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
    $("#studentFeesSubmit").validate({
        rules: {
            monthOnly:{
                required: true,
            },
            permonthamount: {
                required: true,
            },
            payingamount: {
                required: true,
            }
        },
        messages:{
            monthOnly:{
                required: "Please Fill the Empty Box"
            },
            permonthamount:{
                required: "Please Fill the Empty Box"
            },
            payingamount:{
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
        var data = $('#studentFeesSubmit').serialize();
        var monthOnly = $('#monthOnly').val();
        var stuid = $('#stuid').val();
        $.ajax({
           url:"monthCheckStudentFees",
           method:"POST",
           data:{monthOnly:monthOnly, stuid:stuid},
           success:function(jsonData){
               if(jsonData == 'false')
               {
                   alertify.notify("<i>Student Has Paid For This Month</i>", "error", "6", function(){ console.log('dismissed'); });
                    loading = false;
               }
               else if(jsonData == 'true')
               {
                   $.ajax({
                        url: 'StudentFeesProcess',
                        method: 'POST',
                        data:data,
                        success:function(jsonData){
                            if(jsonData != 'notok')
                            {
                                loading = false;
                                $("#hidebutton").hide();
                                setTimeout("location.href = 'printStudentSlip?ReciptNo="+jsonData+"';",1000);
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