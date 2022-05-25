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
    $("#studenfeesPayment").validate({
        rules: {
//            students:{
//                required: true,
//            },
            modeofpay: {
                required: true,
            },
            banknameload: {
                required: true,
            },
            chequeno: {
                required: true,
            },
            chequedate: {
                required: true,
            },
            TotalAmount: {
                required: true,
            },
            reciptno: {
                required: true,
            },
        },
        messages: {
//            students:{
//                required: "Please Fill the Empty Box",
//            },
            modeofpay: {
                required: "Please Fill the Empty Box",
            },
            banknameload: {
                required: "Please Fill the Empty Box",
            },
            chequeno: {
                required: "Please Fill the Empty Box",
            },
            chequedate: {
                required: "Please Fill the Empty Box",
            },
            TotalAmount: {
                required: "Please Fill the Empty Box",
            },
            reciptno: {
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
        var data = $('#studenfeesPayment').serialize();
        $.ajax({
            url: 'StudentsFeesCollectionUpdate',
            method: 'POST',
            data: data,
            success: function (jsonData) {
//                alert(jsonData);
                if (jsonData != 'notok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Saved Successfully</b></i>", "success", "3",
                            function ()
                            {
                                console.log('dismissed');
                                $("#hidebutton").show();
                                setTimeout("location.href = 'printStudentSlip?ReciptNo=" + jsonData + "';", 200);
                                setTimeout("location.href = 'FeeCollection';", 350);
                            });
                }
                else if (jsonData == 'notok')
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