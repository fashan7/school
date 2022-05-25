$(document).ready(function () {
    var loading = false;
    if (loading) {
        return;
    }
    loading = true;
    var nameregex = /^[a-zA-Z ]+$/;
    $.validator.addMethod("validname", function (value, element) {
        return this.optional(element) || nameregex.test(value);
    });

    var eregex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    $.validator.addMethod("validemail", function (value, element) {
        return this.optional(element) || eregex.test(value);
    });
    $("#leaveDetailsReg").validate({
        rules: {
            leaveCategory: {
                required: true,
            },
            department: {
                required: true,
            },
            leavecount: {
                required: true,
                number: true
            },
        },
        messages: {
            leaveCategory: {
                required: "Please Fill the Empty Box"
            },
            department: {
                required: "Please Fill the Empty Box"
            },
            leavecount: {
                required: "Please Fill the Empty Box",
                number: "Only Numbers"
            }
        },
        errorPlacement: function (error, element) {
            $(element).closest('.form-group').find('.help-block').html(error.html());
        },
        highlight: function (element) {
            $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
            $(element).closest('.form-group').find('.help-block').html('');
        },
        submitHandler: function (form) {
            $("#hidebutton").hide();
            ajaxSaving();
            loading = false;
        }
    });

    function ajaxSaving()
    {
        var data = $('#leaveDetailsReg').serialize();
        $.ajax({
            url: 'LeaveDetailsRegister',
            method: 'POST',
            data: data,
            success: function (jsonData) {
                if (jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Saved Successfully</b></i>", "success", "3",
                            function ()
                            {
                                console.log('dismissed');
                                $("#hidebutton").show();
                                $("#leavecount").val("");
                                $("#leavecount").closest('.form-group').removeClass('has-success');
                                $("#department").val("");
                                $("#department").closest('.form-group').removeClass('has-success');
                                $("#leaveCategory").val("");
                                $("#leaveCategory").closest('.form-group').removeClass('has-success');
                                fetch_category();
                            });
                }
                else
                {
                    alertify.notify("Something Went Wrong", "error", "3", function () {
                        console.log('dismissed');
                    });
                    loading = false;
                }
            }
        });
    }

    function fetch_category()
    {
        $.ajax({
            url: "loadCategoryDetailsToedit",
            method: "POST",
            success: function (jsonData)
            {
                $('#loadCatnames').html(jsonData);
            }
        });
    }
});