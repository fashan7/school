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
    $("#feeallocationReg").validate({
        rules: {
            feecategory: {
                required: true,
            },
            feesubcategoryname: {
                required: true,
            },
            feesfor: {
                required: true,
            },
            gradenumberlist: {
                required: true,
            },
            'students[]': {
                required: true,
            },
        },
        messages: {
            feecategory: {
                required: "Please Fill the Empty Box",
            },
            feesubcategoryname: {
                required: "Please Fill the Empty Box",
            },
            feesfor: {
                required: "Please Fill the Empty Box",
            },
            gradenumberlist: {
                required: "Please Fill the Empty Box",
            },
            'students[]': {
                required: "Please Fill the Empty Box",
            },
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
        var data = $('#feeallocationReg').serialize();
        $.ajax({
            url: 'feeAllocationRegister',
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
                                setTimeout("location.href = 'FeeAllocation';", 250);
                            });
                }
                else if(jsonData === 'oops')
                {
                    alertify.notify("Duplicated Allocation", "error", "3", function () {
                        console.log('dismissed');
                        setTimeout("location.href = 'FeeAllocation';", 250);
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
});