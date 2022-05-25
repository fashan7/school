<?php get_header($title); ?>
<?php
$mat = new materialController;
$bookingid = $_GET['dontRefresh'];
$result = $mat->exambooking($bookingid);
$paperno = $result['paperid'];

$resultStidm = $mat->SelectStudentbyid($result['student_id']);

$totalques = $mat->getQuestioncount($paperno);
?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>    
<?php
if ($result['status'] == "booked") {
    ?>

    <body >
        <div id="fullscreen">
            <div class="row" >
                <div class="col-md-2">
                    <div class="ibox" style="height: auto">
                        <div style="width: 100%; text-align: center;">Powered By</div>
                        <img src="../public/media/fashan/twa.png" width="100%">
                    </div>
                    <div class="ibox">
                        <div class="row"></div>
                        <div class="footer bottom-navbar" style="width: 100%; text-align: center; font-size: 10px">
                            copyrights &copy; <?= date('Y') ?> <a href="https://www.linkedin.com/in/mohammed-fashan-a59092187/" style="text-decoration: none" target="_blank">Fashan</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-10">                   
                    <div id="testpad"></div>
                    <div class="ibox">
                        <div class="row">
                            <div class="col-md-10">
                                <div class="progress">
                                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:40%"></div>
                                </div>
                            </div>
                            <div class="col-md-2"><span class="pull-right" id="spnTimer" style="font-size: 20px; color:red"><i>loading...</i></span></div>
                        </div>
                        <input type="hidden" id="currentQuestionId" value="1">
                        <input type="hidden" id="totalQuestionCount" value="<?= $totalques ?>">
                        <input type="hidden" id="exid" value="<?= $result['id'] ?>">
                        <input type="hidden" id="stdid" value="<?= $result['student_id'] ?>">
                        <input type="hidden" id="stdidname" value="<?= $resultStidm['studentname'].' - '.$resultStidm['studentcode'] ?>">
                        <input type="hidden" id="date">
                        <input type="hidden" id="stime">
                        <input type="hidden" id="etime">
                        <input type="hidden" id="bookinggid" name="bookinggid" value="<?= $bookingid ?>">
                        <label id="lblquest">Question Pad (Scrollable)</label>
                        <div class="owl-carousel" id="qpaneldiv" style="border: 2px double blue; border-radius:10px; padding: 5px">
                            question carousel
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="ibox">
                        <div id="startover" style="display: block; text-align: center"><a href="javascript:void(0)" id="clicktostartExam"><img src="../public/media/fashan/start.png" style="width: 400px; height: 400px"></a></div>
                        <div id="timeover" style="display: none; text-align: center"><img src="../public/media/fashan/finish.png" style="width: 400px; height: 400px"></div>
                        <div id="showdiv" style="display: none"> 
                            <div id="QuestionContentPad" ></div>
                            <div style="height: 50px">
                                <button class="btn btn-info" id="btnPrev"><i class="fa fa-chevron-left"></i> Prev 
                                </button>
                                <button class="btn btn-info" id="btnNext">Next <i class="fa fa-chevron-right"></i>
                                </button>
                                <button class="btn btn-success pull-right" id="finishExam">Finish Exam</button>
                            </div>
                        </div>
                    </div>
                </div>                
            </div>        
            <div class="jquery-script-clear"></div>
            <?php get_footer(); ?>
        </div>
    </body>
    <script type="text/javascript">
        var elem = document.documentElement;
        var checkedAns = new Array();

        /* Function to open fullscreen mode */
        function openFullscreen() {
            if (elem.requestFullscreen) {
                elem.requestFullscreen();
            } else if (elem.mozRequestFullScreen) { /* Firefox */
                elem.mozRequestFullScreen();
            } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari & Opera */
                elem.webkitRequestFullscreen();
            } else if (elem.msRequestFullscreen) { /* IE/Edge */
                elem.msRequestFullscreen();
            }
        }
        window.onbeforeunload = function () {
            return "Dude, are you sure you want to leave? Think of the kittens!";
        }
        function disableF5(e) {
            if ((e.which || e.keyCode) == 116 || (e.which || e.keyCode) == 82)
                e.preventDefault();
        }
        ;
        $(function () {
            $('.drawer').slideDrawer({
                showDrawer: true,
                slideTimeout: true, slideSpeed: 600,
                slideTimeoutCount: 3000, });
        });

        function selectDiv(div, que, num) //q1,1 Q24
        {
            $('.' + div).css('font-weight', '');
            $('.' + div + '-' + que).css('font-weight', 'bolder');
            $('#' + div).css('background-color', 'blue');
            $('#' + div).css('color', 'white');
            $('.' + div + '-' + que).css('font-weight', 'bolder');

            checkedAns[num - 1] = que;
            //        console.log(checkedAns);
        }
        $(document).ready(function () {
            $('#clicktostartExam').click(function () {
                $('#startover').css("display", "none");
                $('#showdiv').css("display", "block");
                openFullscreen();
            });

            $(document).on("keydown", disableF5);
            $('#btnPrev').click(function () {
                var current = $('#currentQuestionId').val();
                toggleContent(parseInt(current) - 1);
            });
            $('#btnNext').click(function () {
                var current = $('#currentQuestionId').val();
                toggleContent(parseInt(current) + 1);
            });
        });

        function toggleContent(Qid)
        {
            var current = $('#currentQuestionId').val();
            $('#currentQuestionId').val(Qid);
            $('#Question' + current).hide();
            $('#Question' + Qid).show();

            if (parseInt(Qid) === 1)
            {
                $('#btnPrev').prop('disabled', true);
            }
            else
            {
                $('#btnPrev').prop('disabled', false);
            }

            if (parseInt(Qid) === parseInt($('#totalQuestionCount').val()))
            {
                $('#btnNext').prop('disabled', true);
            }
            else
            {
                $('#btnNext').prop('disabled', false);
            }
        }
        $(document).ready(function () {
            $("#testpad").sidebar({
                open: "click",
                width: '100'
            });
        });


        history.pushState(null, null, document.URL);
        window.addEventListener('popstate', function () {
            history.pushState(null, null, document.URL);
        });

        $(function () {
            $(document).keydown(function (e) {
                return (e.which || e.keyCode) !== 116;
            });
        })
    </script>
    <script type="text/javascript">
        $(function () {
            $('#fullscreen .requestfullscreen').click(function () {
                $('#fullscreen').fullscreen();
                return false;
            });
            $(document).bind('fscreenchange', function (e, state, elem) {
                if ($.fullscreen.isFullScreen()) {
                    $('#fullscreen .requestfullscreen').hide();
                    $('#fullscreen .exitfullscreen').show();
                } else {
                    $('#fullscreen .requestfullscreen').show();
                    $('#fullscreen .exitfullscreen').hide();
                }
            });
        });
    </script>
    <?php
} else {
    ?>

    <script type="text/javascript">
        $(document).ready(function () {
            setTimeout("location.href = 'index';", 0);
        });
    </script>  
    <?php
}
?>