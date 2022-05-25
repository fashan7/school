<?php
$paperid = $_POST['paperno'];
$mat = new materialController;
$result = $mat->ExamPaper($paperid);

$resulttblsubject = $mat->getSubjectsbyPaperid($result['subject_id']);
$resultSubject = $mat->getSubjecSIngle($resulttblsubject['subject_name_id']);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Fashaan</title>
        <!-- All the CSS -->
        <link rel="stylesheet" type="text/css" href="../public/css/bootstrap.min.css" />
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link rel="stylesheet" href="/../public/css/jquery-confirm.min.css">  

        <!-- All the JS -->
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/jquery-confirm.min.js"></script>
        <script src="../public/js/tinymce/js/tinymce/tinymce.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function (e) {
                tinymce.init({
                    selector: "textarea",
                    theme: "modern",
                    paste_data_images: true,
                    images_upload_url: '/postAcceptor',
                    automatic_uploads: true,
                    plugins: [
                        "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                        "searchreplace wordcount visualblocks visualchars code fullscreen",
                        "insertdatetime media nonbreaking save table contextmenu directionality",
                        "emoticons template paste textcolor colorpicker textpattern"
                    ],
                    toolbar1: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code",
                    toolbar2: "preview media | forecolor backcolor emoticons",
                    image_advtab: true,
                    file_picker_callback: function (callback, value, meta) {
                        if (meta.filetype == 'image') {
                            $('#upload').trigger('click');
                            $('#upload').on('change', function () {
                                var file = this.files[0];
                                var reader = new FileReader();
                                reader.onload = function (e) {
                                    callback(e.target.result, {
                                        alt: ''
                                    });
                                };
                                reader.readAsDataURL(file);
                            });
                        }
                    },
                    templates: [{
                            title: 'Test template 1',
                            content: 'Test 1'
                        }, {
                            title: 'Test template 2',
                            content: 'Test 2'
                        }]
                });
            });

        </script>
    </head>
    <body>
        <div class="container" style="width: 100%; margin-top: 10px">
            <div class="row">
                <div class="col-md-8">
                    <input type="hidden" name="paperid" id="paperid" value="<?= $paperid ?>">
                    <input type="hidden" name="noofquestion" id="noofquestion" value="<?= $result['no_of_question'] ?>">
                    <dl class="dl-horizontal">
                        <dt>Paper No :</dt>
                        <dd id="Pno"><?= $result['exampaper_no'] ?></dd>
                        <dt>Subject :</dt>
                        <dd id="Pnooo"><?= $resultSubject['sub_name'] ?></dd>
                        <dt>Question Number :</dt>
                        <dd id="Qno"><span style="color:red">Please select from right panel</span></dd>
                    </dl>
                    <hr>
                    <div id="qpanel">
                        <div class="well">
                            <strong>Question</strong>
                            <textarea id="question"></textarea>
                        </div>
                        <div class="well">
                            <strong>Answer No : 01</strong>
                            <textarea id="answer1"></textarea>
                            <br>
                            <strong>Answer No : 02</strong>
                            <textarea id="answer2"></textarea>
                            <br>
                            <strong>Answer No : 03</strong>
                            <textarea id="answer3"></textarea>
                            <br>
                            <strong>Answer No : 04</strong>
                            <textarea id="answer4"></textarea>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div id="savediv" class="well">
                        <strong>Correct Answer</strong>
                        <select class="form-control" id="correct">
                            <option value="0">-- Select Answer--</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                        <div style="padding-top: 10px">
                            <button class="btn btn-success btn-block" id="btnsave">Save Question</button>
                        </div>
                    </div>
                    <div class="well" id="qpad">
                        <!--  -->
                    </div>
                    <div class="well" id="puslish" style="display:none">					
                        <div style="padding-top: 10px">
                            <button class="btn btn-primary btn-block" id="btnpublish">Publish Paper</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(document).ready(function () {
                $('#qpanel').hide(500);
                loadQpad();
            })
            // display all the question numbers here
            function loadQpad()
            {
                var paper = $('#paperid').val();
                var noofquestion = $('#noofquestion').val();
                $.ajax({
                    type: 'POST',
                    url: '/loadQpad',
                    data: {paper: paper, noofquestion: noofquestion},
                    success: function (data) {
                        $('#qpad').html('<div class="row">' + data + "</div>");
                    }
                });
            }
            setInterval(checkPushlish, 1000);
            setInterval(loadQpad, 1000);
            function checkPushlish()
            {
                var paper = $('#paperid').val();
                var noofquestion = $('#noofquestion').val();
                $.ajax({
                    url: "TotalNoOfQuestion",
                    method: "POST",
                    data: {paper: paper},
                    success: function (jsonData) {                        
                        if (noofquestion === jsonData)
                        {
                            document.getElementById("puslish").style.display = "block";
                        }
                        else
                        {
                            document.getElementById("puslish").style.display = "none";
                        }
                    }
                });
            }

            $(document).on('click', '#btnpublish', function () {
                var paper = $('#paperid').val();
                $.ajax({
                    url: "ConfirmExamPublish",
                    method: "POST",
                    data: {paper: paper},
                    success: function (jsonData) {
                        setTimeout("location.href = 'ExamPaperCreation';", 0);
                    }
                });
            });

            $(document).ready(function () {
                $('#btnsave').click(function (e) {
                    tinyMCE.triggerSave();
                    var question = $('#question').val();
                    var answer1 = $('#answer1').val();
                    var answer2 = $('#answer2').val();
                    var answer3 = $('#answer3').val();
                    var answer4 = $('#answer4').val();
                    var correct = $('#correct').val();
                    // `question_id`, `paper_id`, `question_text`, `question_order`, `points`, `correct`, `ext`
                    // `answer_id`, `question_id`, `answer_text`, `answer_order`, `ext`

                    if ($('#question').val() !== "" && $('#answer1').val() !== "" && $('#answer2').val() !== "" && $('#answer3').val() !== "" && $('#answer4').val() !== "" && $('#answer5').val() !== "") {
                        var data = [
                            $('#Pno').html(),
                            $('#question').val(),
                            $('#Qno').html(),
                            $('#correct').val(),
                            $('#answer1').val(),
                            $('#answer2').val(),
                            $('#answer3').val(),
                            $('#answer4').val(),
                        ];

                        $.ajax({
                            type: 'POST',
                            url: '/save_ques',
                            data: {datum: data},
                            success: function (data) {
                                $('#qpanel').hide(500);
                                $('#correct').val(0);
                                $('#Qno').html('<span style="color:red">Please select from right panel</span>');
                                $.alert(data);
                                loadQpad();
                            }
                        });
                    }

                });
            });
            function getQue(paper, id)
            {
                $('#Qno').html(id);
                if (paper != 0) {
                    $.ajax({
                        type: 'POST',
                        url: 'get_que',
                        data: "paper=" + paper + "&que=" + id,
                        success: function (data) {
                            $('#qpanel').show();
                            var myObj = JSON.parse(data);
                            tinymce.get('question').setContent(myObj[0]);
                            tinymce.get('answer1').setContent(myObj[2]);
                            tinymce.get('answer2').setContent(myObj[3]);
                            tinymce.get('answer3').setContent(myObj[4]);
                            tinymce.get('answer4').setContent(myObj[5]);
                            $('#correct').val(myObj[1]);
                        }
                    });
                } else {
                    $('#qpanel').show();
                    tinymce.get('question').setContent('');
                    tinymce.get('answer1').setContent('');
                    tinymce.get('answer2').setContent('');
                    tinymce.get('answer3').setContent('');
                    tinymce.get('answer4').setContent('');
                    $('#correct').val(0);
                }
            }
        </script>
    </body>
</html>