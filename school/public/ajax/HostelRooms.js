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
    $("#hostelroomsReg").validate({
        rules: {
            hosteltype: {
                required: true
            },
            hostelname: {
                required: true
            },
            floorname: {
                required: true
            },
            roomno: {
                required: true
            },
            noofbeds: {
                required: true
            },
            amount: {
                required: true,
                number: true
            },
            RoomNo1: {
                required: true
            },
            NoofBed1: {
                required: true
            },            
            RentAmount1: {
                required: true
            },
            feetype: {
                required: true
            },
        },
        messages:{
            hosteltype:{
                required: "Please Fill the Empty Box"
            },
            hostelname:{
                required: "Please Fill the Empty Box"
            },
            floorname:{
                required: "Please Fill the Empty Box"
            },
            noofbeds:{
                required: "Please Fill the Empty Box"
            },
            roomno:{
                required: "Please Fill the Empty Box"
            },
            amount:{
                required: "Please Fill the Empty Box",
                number: "Please Enter a Numeric Value"
            },
            RoomNo1:{
                required: "Please Fill the Empty Box"
            },
            NoofBed1:{
                required: "Please Fill the Empty Box"
            },
            RentAmount1:{
                required: "Please Fill the Empty Box"
            },
            feetype:{
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
        var data = $('#hostelroomsReg').serialize();
        $.ajax({
            url: 'HostelRoomsRegister',
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
                            setTimeout("location.href = 'hostelRooms';",350);
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