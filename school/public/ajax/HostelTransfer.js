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
    $("#hostelTranferUpd").validate({
        rules: {
            usertype: {
                required: true,
            },
            SearchStudent: {
                required: true,
            },
            Searchemployee: {
                required: true,
            },
            staffid: {
                required: true,
            },
            studentid: {
                required: true,
            },
            hosteltype: {
                required: true,
            },
            hostelname: {
                required: true,
            },
            hostelroomID: {
                required: true,
            },
            optionofEdit: {
                required: true,
            },
        },
        usertype:{
            usertype:{
                required: "Please Fill the Empty Box",
            },
            staffid:{
                required: "Please Fill the Empty Box",
            },
            studentid:{
                required: "Please Fill the Empty Box",
            },
            SearchStudent:{
                required: "Please Fill the Empty Box",
            },
            Searchemployee:{
                required: "Please Fill the Empty Box",
            },
            hosteltype:{
                required: "Please Fill the Empty Box",
            },
            hostelname:{
                required: "Please Fill the Empty Box",
            },            
            hostelroomID:{
                required: "Please Fill the Empty Box",
            },
            optionofEdit:{
                required: "Please Fill the Empty Box",
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
        var data = $('#hostelTranferUpd').serialize();
        $.ajax({
            url: 'HostelMemberUpdateTransfer',
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
                            setTimeout("location.href = 'hostelTransfer';",350);
                        });
                }
                else if(jsonData == 'vacateErrTrans')
                {
                    alertify.notify("This User Should Register First", "error", "6", function(){ console.log('dismissed'); });
                    loading = false;
                }
                else if(jsonData == 'notfound')
                {
                    alertify.notify("No Records Found On this User", "error", "6", function(){ console.log('dismissed'); });
                    loading = false;   
                }
                else if(jsonData == 'vacateErr')
                {
                    alertify.notify("This User Already Left the Room", "error", "6", function(){ console.log('dismissed'); });
                    loading = false;
                }
                else if(jsonData == 'oops')
                {
                    alertify.notify("Dont Update The Same Room", "error", "6", function(){ console.log('dismissed'); });
                    loading = false;
                }
                else if(jsonData == 'miss')
                {
                    alertify.notify("Search A User and Trigger the Go Button", "error", "6", function(){ console.log('dismissed'); });
                    loading = false;   
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