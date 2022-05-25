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

    jQuery.validator.addMethod("greaterThan",
            function (value, element, params) {

                if (!/Invalid|NaN/.test(new Date(value))) {
                    return new Date(value) >= new Date($(params).val());
                }

                return isNaN(value) && isNaN($(params).val())
                        || (Number(value) > Number($(params).val()));
            }, 'Must be greater than From Date.');

    $("#leaveAppReg").validate({
        rules: {
            leaveCategory: {
                required: true,
            },
            fromdate: {
                required: true,
            },
            todate: {
                required: true,
                greaterThan: "#fromdate",
            },
            department: {
                required: true,
            },
            staffmem: {
                required: true,
            },
            reason: {
                required: true,
            },
        },
        messages: {
            leaveCategory: {
                required: "Please Fill the Empty Box"
            },
            fromdate: {
                required: "Please Fill the Empty Box"
            },
            todate: {
                required: "Please Fill the Empty Box"
            },
            department: {
                required: "Please Fill the Empty Box"
            },
            staffmem: {
                required: "Please Fill the Empty Box"
            },
            reason: {
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
        var data = $('#leaveAppReg').serialize();
        $.ajax({
            url: 'LeaveApplicationRegister',
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
                                $("#hidebutton").show();
                                $("#leaveCategory").val("");
                                $("#leaveCategory").closest('.form-group').removeClass('has-success');
                                $("#fromdate").val("");
                                $("#fromdate").closest('.form-group').removeClass('has-success');
                                $("#todate").val("");
                                $("#todate").closest('.form-group').removeClass('has-success');
                                $("#reason").val("");
                                $("#reason").closest('.form-group').removeClass('has-success');
                                $('#employee').html("");
                                $("#department").val("");
                                $("#department").closest('.form-group').removeClass('has-success');
                                setTimeout("location.href = 'TeacherleaveApplication';", 300);
                            });
                }
                else if (jsonData == 'oops')
                {
                    alertify.notify("No Of Days Exceeded The Limits", "error", "6", function () {
                        console.log('dismissed');
                    });
                    loading = false;
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