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
    $("#bookcateReg").validate({
        rules: {
            categoryname: {
                required: true,
                remote: {
                    url: 'bookCategoryValidation',
                    type: 'POST',
                    data: {
                        categoryname: function(){
                            return $("#categoryname").val();
                        }
                    }
                }
            },
            sectioncode:{
                required: true,
                remote: {
                    url: 'bookCategorySectionValidation',
                    type: 'POST',
                    data: {
                        sectioncode: function(){
                            return $("#sectioncode").val();
                        }
                    }
                }
            }
        },
        messages:{
            categoryname:{
                required: "Please Fill the Empty Box",
                remote: "Category Name Already Taken"
            },
            sectioncode:{
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
        var data = $('#bookcateReg').serialize();
        $.ajax({
            url: 'bookCategoryRegister',
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
                        
                            $("#categoryname").val("");
                            $("#categoryname").closest('.form-group').removeClass('has-success');
                            $("#sectioncode").val("");
                            $("#sectioncode").closest('.form-group').removeClass('has-success');
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