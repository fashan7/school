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
    
    
    
    $("#HostelFeesPayment").validate({
        rules: {
            usertype: {
                required: true
            },
            SearchStudent: {
                required: true
            },
            Searchemployee: {
                required: true
            },
            studentid: {
                required: true
            },
            staffid: {
                required: true
            },
            'feetypes[]': {
                required: true,
            },
            amount: {
                required: true
            },
            fine: {
                required: true
            },
            discount: {
                required: true
            },
            modeofpay: {
                required: true
            },
            banknameload: {
                required: true
            },
            chequeno: {
                required: true
            },
            chequedate: {
                required: true
            },
            payingamount: {
                required: true
            },
            reciptno: {
                required: true
            },
        },
        messages:{
            usertype:{
                required: "Please Fill the Empty Box"
            },
            SearchStudent:{
                required: "Please Fill the Empty Box"
            },
            Searchemployee:{
                required: "Please Fill the Empty Box"
            },
            'feetypes[]':{
                required: 'Please select at least 2 things.',
            },
            fine:{
                required: "Please Fill the Empty Box"
            },
            discount:{
                required: "Please Fill the Empty Box"
            },
            modeofpay:{
                required: "Please Fill the Empty Box"
            },
            banknameload:{
                required: "Please Fill the Empty Box"
            },
            chequeno:{
                required: "Please Fill the Empty Box"
            },
            chequedate:{
                required: "Please Fill the Empty Box"
            },
            payingamount:{
                required: "Please Fill the Empty Box"
            },
            reciptno:{
                required: "Please Fill the Empty Box"
            },
            amount:{
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
        var data = $('#HostelFeesPayment').serialize();
        $.ajax({
            url: 'HostelFeeCollection',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData != 'notok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Saved Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebutton").show(); 
                            setTimeout("location.href = 'hostelInvoice?ReciptNo="+jsonData+"';",200);
                            setTimeout("location.href = 'HostelFeeCollection';",350);
                        });
                }
                else if(jsonData == "notok")
                {
                    alertify.notify("Something Went Wrong", "error", "3", function(){ console.log('dismissed'); });
                    loading = false;
                }
            }
        });
    }
});