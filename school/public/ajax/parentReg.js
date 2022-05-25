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
    $.validator.addMethod('crequiredUrl', $.validator.methods.required,
            'This field is required.');

    $.validator.addClassRules({
        grdcls: {// here authUrl is one of the class Name for the input row..
            crequiredUrl: true
        },
        stdcls: {// here authUrl is one of the class Name for the input row..
            crequiredUrl: true
        }
    });

    $("#parentReg").validate({
        rules: {
            username: {
                validname: true,
                required: true,
                remote: {
                    url: 'parentUsernameValidation',
                    type: 'POST',
                    data: {
                        username: function () {
                            return $("#username").val();
                        }
                    }
                }
            },
            parentemail: {
                required: true,
                email: true
            },
            npassword: {
                required: true,
                minlength: 5
            },
            conpassword: {
                required: true,
                equalTo: "#npassword"
            },
            student1: {
                required: true
            },
            grade1: {
                required: true
            }
        },
        messages: {
            parentemail: {
                required: "Please Fill the Empty Box",
                email: "Please enter a valid email address"
            },
            username: {
                required: "Please Fill the Empty Box",
                validname: "Enter a valid name",
                remote: "Username Name Already Taken"
            },
            npassword: {
                required: "Please Fill the Empty Box",
                minlength: "Your password must be at least 5 characters long"
            },
            conpassword: {
                required: "Please Fill the Empty Box",
                equalTo: "Password is Not Matched"
            },
            student1: {
                required: "Please Fill the Empty Box"
            },
            grade1: {
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
        var data = $('#parentReg').serialize();
        $.ajax({
            url: 'parentRegRegister',
            method: 'POST',
            data: data,
            success: function (jsonData) {
//                alert(jsonData)
                if (jsonData == 'ok')
                {
                    loading = false;
                    $("#hidebutton").hide();
                    alertify.notify("<i><b>Saved Successfully</b></i>", "success", "3",
                            function ()
                            {
                                console.log('dismissed');
                                $("#hidebutton").show();
                            });

                    setTimeout("location.href = 'parent_reg';", 1000);
                }
                else if (jsonData == "oops") {
                    alertify.notify("<i><b>Saved Successfully but students are allocated for their parents</b></i>", "success", "3",
                            function ()
                            {
                                console.log('dismissed');
                                $("#hidebutton").show();
                            });
                    setTimeout("location.href = 'parent_reg';", 2500);
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