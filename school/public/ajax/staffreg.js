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
    $("#staffregistersubmit").validate({
        rules: {
            fullname: {
                required: true
            },
            code: {
                required: true,
                remote: {
                    url: 'staffCodeValidation',
                    type: 'POST',
                    data: {
                        code: function(){
                            return $("#code").val();
                        }
                    }
                }
            },
            address: {
                required: true
            },
            gender: {
                required: true
            },
            dob: {
                required: true
            },
            datepicker:{
                required: true
            },
            department:{
                required: true
            },
            phone1: {
                required: true
            },
            phone2: {
                required: true
            },
            email: {
             required: true,
             validemail: true
            },
            schoolname: {
                validname: true,
                required: true
            },
            designation: {
                validname: true,
                required: true
            },
            workperiod: {
                required: true
            },
        },
        messages:{
            fullname:{
                required: "Please Fill the Empty Box"
            },
            code:{
                required: "Please Fill the Empty Box",
                remote: "Code Already Taken"
            },
            address:{
                required: "Please Fill the Empty Box"
            },
            datepicker:{
                required: "Please Fill the Empty Box"
            },
            department:{
                required: "Please Fill the Empty Box"
            },
            gender:{
                required: "Please Fill the Empty Box"
            },
            dob:{
                required: "Please Fill the Empty Box"
            },
            phone1:{
                required: "Please Fill the Empty Box"
            },
            phone2:{
                required: "Please Fill the Empty Box"
            },
            email:{
                required: "Please Fill the Empty Box",
                validemail: "Enter Valid Email Address"
            },
            schoolname:{
                required: "Please Fill the Empty Box",
                validname: "Enter a valid name"
            },
            designation:{
                required: "Please Fill the Empty Box",
                validname: "Enter a valid name"
            },
            workperiod:{
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
        var data = $('#staffregistersubmit').serialize();
        $.ajax({
            url: 'staffregistersubmit',
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
                            $("#fullname").val("");
                            $("#code").val("");
                            $("#address").val("");
                            $("#phone1").val("");
                            $("#phone2").val("");
                            $("#email").val("");
                            $("#olnums").val("1");
                            $("#alnums").val("1");
                            $("#schoolname").val("");
                            $("#designation").val("");
                            $("#olcheck").val("yes");
                            $("#alcheck").val("yes");
                            $("#workcheck").val("yes");
                            $("#olresult1").val("");
                            $("#olSubject1").val("");
                            $("#alresult1").val("");
                            $("#alSubject1").val("");
                            $("#attachmentpic").val("");
                        
                            $("#datepicker").val("");
                            $("#department").val("");
                        
                            $("#day").val("");
                            $("#month").val("");
                            $("#year").val("");
                            $("#workperiod1").val("");
                            $("#workperiod2").val("");
                            $("#workperiod3").val("");
                        
                            document.getElementById("aladdrowid").innerHTML = "";
                            document.getElementById("oladdrowid").innerHTML = "";
                            document.getElementById("olcheck").checked = false;
                            document.getElementById("alcheck").checked = false;
                            document.getElementById("workcheck").checked = false;
                            document.getElementById("olhidden").style.display="none";
                            document.getElementById("alhidden").style.display="none";
                            document.getElementById("workhidden").style.display="none";
                        
                            $("#datepicker").closest('.form-group').removeClass('has-success');
                            $("#department").closest('.form-group').removeClass('has-success');
                        
                            $("#fullname").closest('.form-group').removeClass('has-success');
                            $("#code").closest('.form-group').removeClass('has-success');
                            $("#address").closest('.form-group').removeClass('has-success');
                            $("#gender").closest('.form-group').removeClass('has-success');
                            $("#phone1").closest('.form-group').removeClass('has-success');
                            $("#phone2").closest('.form-group').removeClass('has-success');
                            $("#email").closest('.form-group').removeClass('has-success');
                            $("#schoolname").closest('.form-group').removeClass('has-success');
                            $("#designation").closest('.form-group').removeClass('has-success');
                        
                            $("#day").closest('.form-group').removeClass('has-success');
                            $("#month").closest('.form-group').removeClass('has-success');
                            $("#year").closest('.form-group').removeClass('has-success');
                            $("#workperiod1").closest('.form-group').removeClass('has-success');
                            $("#workperiod2").closest('.form-group').removeClass('has-success');
                            $("#workperiod3").closest('.form-group').removeClass('has-success');
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