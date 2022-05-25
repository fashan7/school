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
    $("#cllasAlloc").validate({
        rules: {
            staffno: {
                required: true
            },
            gradenumberlist: {
                required: true
            }
        },
        messages: {
            staffno: {
                required: "Please Fill the Empty Box"
            },
            gradenumberlist: {
                required: "Please Fill the Empty Box"
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
        var data = $('#cllasAlloc').serialize();
        $.ajax({
            url: 'classAllocaRegister',
            method: 'POST',
            data: data,
            success: function (jsonData) {
//                alert(jsonData);
                if (jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Saved Successfully</b></i>", "success", "3",
                            function ()
                            {
                                console.log('dismissed');
                                setTimeout("location.href = 'class_allocation';", 0);

                            });
                }
                else if (jsonData === "oops") {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Already Allocated</b></i>", "error", "3",
                            function ()
                            {
                                console.log('dismissed');
                                $("#hidebutton").show();

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

    function fetch_bank()
    {
        $.ajax({
            url: "loadbankDetailsToedit",
            method: "POST",
            success: function (jsonData)
            {
                $('#loadbank').html(jsonData);
            }
        });
    }
});