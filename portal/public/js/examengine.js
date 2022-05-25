/*
 * jQuery Exam Engine
 * Copyright (c) 2018 Rubiikx
 * Version: 1.0.1 (26-JAN-2018)
 * Licensed under the MIT license.
 * Requires: jQuery latest.
 */
$(document).ready(function (exc) {
    /* countdown gonna start from here*/
    var exid = $('#exid').val();
    $.ajax({
        type: 'GET',
        url: '/question',
        data: {exid: exid},
        success: function (data) {
            $('#QuestionContentPad').html(data);
            toggleContent(1);
            $('input:radio').screwDefaultButtons({
                image: 'url("public/plug-img/radioSmall.jpg")',
                width: 43,
                height: 43
            });
        }
    });
    $.ajax({
        type: 'GET',
        url: '/countTime',
        data: {exid: exid},
        success: function (data) {
            var div = '';
            myObj = JSON.parse(data);
            runTime(myObj[0], myObj[1]);
            $('#totalQuestionCount').val(myObj[2]);
            $('#date').val(myObj[3]);
            $('#stime').val(myObj[4]);
            $('#etime').val(myObj[5]);
            for (var i = 1; i <= myObj[2]; i++)
            {
                div += '<div><button style="width:50px; font-weight:bold" class="btn btn-default" id="Q' + i + '" onclick="toggleContent(' + i + ')">' + i + "</button></div>";
            }
            $('#qpaneldiv').html(div);
            $(".owl-carousel").owlCarousel({
                items: 20
            });
        }
    });
});

function runTime(max, time)
{
    var val;
    setInterval(function () {
        val = (time / max) * 100 + "%";
        if (time >= 0) {
            $('#spnTimer').html(parseInt(val));
            $('.progress-bar').width(val);
        }
        time--;
        if (val === '0%')
        {
//            alert(val);
            $('#btnPrev').prop("disabled", true);
            $('#btnNext').prop("disabled", true);
            $('#qpaneldiv').css("display", "none");
            $('#lblquest').css("display", "none");
            $('#QuestionContentPad').css("display", "none");
            $('#btnPrev').css("display", "none");
            $('#btnNext').css("display", "none");
            $('#timeover').css("display", "block");
            $('#startover').css("display", "none");
            $('#showdiv').css("display", "block");
            window.top.close();

        }
    }, 1000);
}
$('#finishExam').click(function (e) {
//    if (parseInt(checkedAns.length) === parseInt($('#totalQuestionCount').val())) {
    $.confirm({
        icon: 'fa fa-book',
        title: 'Confirmation!',
        content: 'Do you want to Finish Exam?',
        type: 'blue',
        buttons: {
            Confirm: function () {
                $('#showdiv').css("display", "none");
                var tot = $('#totalQuestionCount').val();
                var final = 0;
                var sheet = '<table style="width:100%"><thead>' +
                        '<tr><th colspan="2">Student</th><th>' + $('#stdidname').val() + '</th><th></th></tr>' +
                        '<tr><th colspan="2">Exam ID</th><th>' + $('#exid').val() + '</th><th></th></tr>' +
                        '<tr><th colspan="2">Exam Date</th><th>' + $('#date').val() + '</th><th></th></tr>' +
                        '<tr><th colspan="2">Exam Time</th><th>' + $('#stime').val() + '</th><th>' + $('#etime').val() + '</th></tr>' +
                        '<tr><th>No#</th><th>Question</th><th>Correct Answer</th><th>Student Answer</th></tr>' +
                        '</thead><tbody>';
                for (var i = 1; i <= tot; i++) {

                    var stringAns = "";
                    if (checkedAns[i - 1] === undefined) {
                        stringAns = "Not Answered";                        
                        
                    } else {
                        stringAns = checkedAns[i - 1];

                    }
                    sheet += '<tr><td>' + i + '</td><td>' + $('#QueTXT' + i).html() + '</td><td>' + $('#ans' + i).val() + '</td><td>' + stringAns + '</td></tr>';
                    if (parseInt($('#ans' + i).val()) === parseInt(checkedAns[i - 1])) {
                        final++;
                    }
                }
                sheet += '</tbody><tfoot><tr><th colspan="2" style="text-align:right">Final Marks</th><th style="text-align:right">' + (final / tot) * 100 + '</th><th></th></tr></tfoot></table>';
                
                var totmarks = (final / tot) * 100;
                
                ress = [
                    $('#stdid').val(),
                    $('#exid').val(),
                    "'" + final + " of " + tot + "'",
                    sheet
                ];
                var boookingid = $('#bookinggid').val();
                
                $.ajax({
                    type: 'POST',
                    url: '/result',
                    data: {result: ress, boookingid:boookingid, totmarks:totmarks},
                    success: function (data) {    
//                        alert(data);
                        $.confirm({
                            icon: 'fa fa-book',
                            title: 'Thank you!',
                            content: 'Your marks updated to the system.',
                            type: 'blue',
                            buttons: {
                                OK: function () {
                                    setTimeout("location.href = 'logoutAction';", 0);
                                }
                            }
                        });
                    }
                });
            },
            Cancel: function () {
            }
        }
    });
});
