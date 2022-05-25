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
    $("#studentregistersubmit").validate({
        rules: {
            studentname: {
                required: true
            },
            studentcode: {
                required: true,
                remote: {
                    url: 'studentCodeValidation',
                    type: 'POST',
                    data: {
                        studentcode: function(){
                            return $("#studentcode").val();
                        },
                    }
                }
            },
            rollno:{
                required: true
            },
            datepicker:{
                required: true
            },
            studentaddress: {
                required: true
            },
            studentgender: {
                required: true
            },
            parentname: {
                required: true
            },
            parentaddress: {
                required: true
            },
            day: {
                required: true
            },
            month: {
                required: true
            },
            year: {
                required: true
            },
            phone1: {
                required: true
            },
            classno:{
                required: true
            },
            schoolname: {
                required: true
            },
            grade: {
                required: true
            },

        },
        messages:{
            studentname:{
                required: "Please Fill the Empty Box"
            },
            studentcode:{
                required: "Please Fill the Empty Box",
                  remote: "Code Already Taken"
            },
            rollno:{
               required: "Please Fill the Empty Box"  
            },
            datepicker:{
               required: "Please Fill the Empty Box"  
            },
            classno:{
               required: "Please Fill the Empty Box" 
            },
            studentaddress:{
                required: "Please Fill the Empty Box"
            },
            studentgender:{
                required: "Please Fill the Empty Box"
            },
            parentname:{
                required: "Please Fill the Empty Box"
            },
            parentaddress:{
                required: "Please Fill the Empty Box"
            },
            day:{
                required: "Please Fill the Empty Box"
            },
            phone1:{
                required: "Please Fill the Empty Box"
            },
            schoolname:{
                required: "Please Fill the Empty Box"
            },
            grade:{
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
        var data = $('#studentregistersubmit').serialize();
        $.ajax({
            url: 'studentregistersubmit',
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
                            $("#studentname").val("");
                            $("#studentcode").val("");
                            $("#rollno").val("");
                            $("#studentaddress").val("");
                            $("#studentgender").val("");
                            $("#schoolname").val("");
                            $("#grade").val("");
                            $("#parentname").val("");
                            $("#parentaddress").val("");
                            $("#phone1").val("");
                            $("#phone2").val("");
                            $("#email").val("");
                            $('#classno').val("");
                            $("#oldschool").val("yes");
                            $('#datepicker').val("");
                            $('#bloodgrp').val("");
                            $('#nationality').val("");
                            $('#studentemail').val("");
                        
                            $("#day").val("");
                            $("#month").val("");
                            $("#year").val("");

                            $("#joindday").val("");
                            $("#joindmonth").val("");
                            $("#joindyear").val("");

                            $("#leftday").val("");
                            $("#leftmonth").val("");
                            $("#leftyear").val("");
                        
                            document.getElementById("oldschool").checked = false;
                            document.getElementById("oldschoolhidden").style.display="none";
                            setTimeout("location.href = 'studentRegister';", 500);
                        
                            $("#studentname").closest('.form-group').removeClass('has-success');
                            $("#studentcode").closest('.form-group').removeClass('has-success');
                            $("#classno").closest('.form-group').removeClass('has-success');
                            $("#studentaddress").closest('.form-group').removeClass('has-success');
                            $("#studentgender").closest('.form-group').removeClass('has-success');
                            $("#schoolname").closest('.form-group').removeClass('has-success');
                            $("#grade").closest('.form-group').removeClass('has-success');
                            $("#parentname").closest('.form-group').removeClass('has-success');
                            $("#parentaddress").closest('.form-group').removeClass('has-success');
                            $("#phone1").closest('.form-group').removeClass('has-success');
                            $("#phone2").closest('.form-group').removeClass('has-success');
                            $("#email").closest('.form-group').removeClass('has-success');
                        
                            $("#rollno").closest('.form-group').removeClass('has-success');
                            $("#datepicker").closest('.form-group').removeClass('has-success');
                            $("#bloodgrp").closest('.form-group').removeClass('has-success');
                            $("#nationality").closest('.form-group').removeClass('has-success');
                            $("#studentemail").closest('.form-group').removeClass('has-success');
                        
                            $("#day").closest('.form-group').removeClass('has-success');
                            $("#month").closest('.form-group').removeClass('has-success');
                            $("#year").closest('.form-group').removeClass('has-success');

                            $("#joindday").closest('.form-group').removeClass('has-success');
                            $("#joindmonth").closest('.form-group').removeClass('has-success');
                            $("#joindyear").closest('.form-group').removeClass('has-success');

                            $("#leftday").closest('.form-group').removeClass('has-success');
                            $("#leftmonth").closest('.form-group').removeClass('has-success');
                            $("#leftyear").closest('.form-group').removeClass('has-success');
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