<?php
$mat = new materialController;
$recieptno = $_GET['ReciptNo'];

$result = $mat->HostelCheckFeesByrecipt($recieptno);
$usertype = $result['usertype'];
$username = '';
$address = '';
$code = '';
$phone = '';
$email = '';
if ($usertype == 'student') {
    $resultStudent = $mat->SelectStudentbyid($result['user']);
    $username = $resultStudent['studentname'];
    $code = $resultStudent['studentcode'];
    $address = $resultStudent['studentadress'];
    $phone = $resultStudent['parentmobile'];
    $email = $resultStudent['studentemail'];
} else if ($usertype == 'employee') {

    $resultStaff = $mat->SelectStaffbyid($result['user']);
    $username = $resultStaff['fullname'];
    $code = $resultStaff['code'];
    $address = $resultStaff['address'];
    $phone = $resultStaff['mobile'];
    $email = $resultStaff['email'];
}

$resultFee = $mat->HostelFeeGetRoomID($result['fees_id']);
$roomID = $resultFee['parent_hostel_rooms'];

$resultRooms = $mat->hostelRoomsDetails($roomID);
$floorname = $resultRooms['floor_name'];
$roomNO = $resultRooms['room_no'];
$feetype = $resultRooms['fees_type'];

$resultHostelName = $mat->hostelDetails($resultRooms['hostel_name']);
$hostelname = $resultHostelName['hostel_name'];

$Resultbank = $mat->SelectBanks($result['bankname']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="images/favicon.png">

        <title>Receipt No : - <?= $recieptno ?></title>
        <link rel="shortcut icon" href="/../public/img/school.png">
        <link href="/../public/css/bucket/bootstrap.min.css" rel="stylesheet">
        <link href="/../public/css/bootstrap-reset.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="/../public/css/bucket/styles.css" rel="stylesheet">
        <link href="/../public/css/bucket/style-responsive.css" rel="stylesheet" />
        <link href="/../public/css/bucket/invoice-print.css" rel="stylesheet" media="all">
    </head>

    <body onload="doPrint();">

        <section id="container" class="print" >
            <section id="main-content">
                <section class="wrapper">
                    <div class="row col-xs-12">
                        <div class="col-md-12 col-xs-12">
                            <section class="panel">
                                <div class="panel-body invoice">
                                    <div class="invoice-header">
                                        <div class="invoice-title col-md-3 col-xs-2" >
                                            <h1>receipt</h1>          
                                            <img class="logo-print" src="/../public/img/Receipt.png" alt="">
                                        </div>
                                        <div class="invoice-info col-md-9 col-xs-10">

                                            <div class="pull-right">
                                                <div class="col-md-6 col-sm-6 pull-left">
                                                    <p>7/12 Charlimont Road, Wellawatte<br>
                                                        Sri Lanka</p>
                                                </div>
                                                <div class="col-md-6 col-sm-6 pull-right">
                                                    <p>Phone: +94 77 1673123 <br>
                                                        Email : fashanzak3@gmail.com</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row invoice-to">
                                        <div class="col-md-4 col-sm-4 pull-left">
                                            <h4>Invoice To:</h4>
                                            <h6><?= $username ?>&nbsp;-&nbsp;<?= $code ?></h6>
                                            <p>
                                                <?= $address ?><br>
                                                <?php
                                                if ($phone != '') {
                                                    ?>
                                                    Phone: &nbsp;<?= $phone ?><br>   
                                                    <?php
                                                }
                                                ?>
                                                <?php
                                                if ($email != '') {
                                                    ?>
                                                    Email: &nbsp;<?= $email ?>   
                                                    <?php
                                                }
                                                ?>
                                            </p>
                                        </div>
                                        <div class="col-md-4 col-sm-5 pull-right">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-5 inv-label">Invoice </div>
                                                <div class="col-md-8 col-sm-7"><?= $recieptno ?></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-5 inv-label">Date </div>
                                                <div class="col-md-8 col-sm-7"><?= $result['paiddate'] ?></div>
                                            </div>
                                            <br>
                                        </div>
                                    </div>
                                    <div>
                                        <table class="table table-invoice" border="1">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Heading</th>
                                                    <th>Frequency</th>
                                                    <th class="text-center">Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $resultLoop = $mat->HostelCheckFeesByAllrecipt($recieptno);
                                                $i = 1;
                                                $total = 0;
                                                foreach ($resultLoop as $row) {
                                                    $resultFee2 = $mat->HostelFeeGetRoomID($row['fees_id']);
                                                    ?>
                                                    <tr>
                                                        <td><?= $i ?></td>
                                                        <td>                                            
                                                            <p><?= $hostelname ?> <br> <?= $floorname ?> - <?= $roomNO ?></p>
                                                        </td>
                                                        <td class="text-center"><p><?= $feetype ?>  (<?= $resultFee2['start_date'] ?> / <?= $resultFee2['end_date'] ?>)</p></td>
                                                        <td class="text-center"><?= $row['paidamount'] ?></td>
                                                    </tr>
                                                    <?php
                                                    $total += $row['paidamount'];
                                                    $i++;
                                                }
                                                ?>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-xs-7 payment-method">
                                            <h4>Payment Method</h4>
                                            <p><?= $result['payment_type'] ?></p>
                                            <?php
                                            if ($result['payment_type'] == 'cheque') {
                                                ?>
                                                <p>Bank Name : <?= $Resultbank['name'] ?></p>
                                                <p>Cheque No : <?= $result['cheque_no'] ?></p>
                                                <p>Cheque Date : <?= $result['cheque_date'] ?></p>
    <?php
}
?>
                                            <br>
                                            <h3 class="inv-label itatic">Signature</h3>
                                        </div>
                                        <div class="col-md-6 col-xs-5  invoice-block pull-right">
                                            <ul class="unstyled amounts">
                                                <li>Total amount : <?= $total ?></li>
                                                <li>Fine : <?= $result['fine'] ?></li>
                                                <li>Discount : <?= $result['discount'] ?></li>                                   

                                                <li class="grand-total">Grand Total : <?= $result['total_amount'] ?></li>
                                            </ul>
                                        </div>
                                    </div>

                                </div>
                            </section>
                        </div>            
                    </div>
                    <!-- page end-->
                </section>
            </section>
            <!--main content end-->

        </section>
        <button class="btn btn-warning" id="gotback" onclick="getBack()">Back</button>        
        <!-- Placed js at the end of the document so the pages load faster -->

        <!--Core js-->
        <script src="/../public/js/ucket/jquery.js"></script>
        <script src="/../public/js/ucket/bootstrap.min.js"></script>
        <script class="include" type="text/javascript" src="/../public/js/jquery.dcjqaccordion.2.7.js"></script>
        <script src="/../public/js/jquery.scrollTo.min.js"></script>
        <script src="/../public/js/jquery.slimscroll.js"></script>
        <script src="/../public/js/jquery.nicescroll.js"></script>
        <!--Easy Pie Chart-->
        <script src="/../public/js/jquery.easypiechart.js"></script>
        <!--Sparkline Chart-->
        <script src="/../public/js/jquery.sparkline.js"></script>
        <!--jQuery Flot Chart-->
        <script src="/../public/js/flot-chart/jquery.flot.js"></script>
        <script src="/../public/js/flot-chart/jquery.flot.tooltip.min.js"></script>
        <script src="/../public/js/flot-chart/jquery.flot.resize.js"></script>
        <script src="/../public/js/flot-chart/jquery.flot.pie.resize.js"></script>



        <!--common script init for all pages-->
        <script src="/../public/ajax/scripts.js"></script>
        <script type="text/javascript">
            function doPrint() {
                window.print();
            }
            function getBack() {
                document.location.href = "HostelFeeCollection";
            }
        </script>

    </body>
</html>
