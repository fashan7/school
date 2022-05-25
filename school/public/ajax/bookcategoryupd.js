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
    $("#bookcateUpd").validate({
        rules: {
            categorynameupd: {
                required: true,
                remote: {
                    url: 'bookCategoryupdValidation',
                    type: 'POST',
                    data: {
                        categorynameupd: function(){
                            return $("#categorynameupd").val();
                        },
                        cid: function(){
                            return $("#cid").val();
                        },
                    }
                }
            },
            sectioncodeupd:{
                required: true,
                remote: {
                    url: 'bookCategorySectionupdValidation',
                    type: 'POST',
                    data: {
                        sectioncodeupd: function(){
                            return $("#sectioncodeupd").val();
                        },
                        cid: function(){
                            return $("#cid").val();
                        },
                    }
                }
            }
        },
        messages:{
            categorynameupd:{
                required: "Please Fill the Empty Box",
                remote: "Category Name Already Taken"
            },
            sectioncodeupd:{
                required: "Please Fill the Empty Box",
                remote: "Section Code Name Already Taken"
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
        var data = $('#bookcateUpd').serialize();
        $.ajax({
            url: 'bookCategoryUpdate',
            method: 'POST',
            data:data,
            success:function(jsonData){
                if(jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebuttons").hide();
                    alertify.notify("<i><b>Updated Successfully</b></i>", "success", "3", 
                        function()
                        { 
                            console.log('dismissed'); 
                            $("#hidebuttons").show(); 
                        
                            $("#categorynameupd").val("");
                            $("#categorynameupd").closest('.form-group').removeClass('has-success');
                            $("#sectioncodeupd").val("");
                            $("#sectioncodeupd").closest('.form-group').removeClass('has-success');
                            setTimeout("location.href = 'libraryCategory';",600);
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