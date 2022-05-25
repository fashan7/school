<?php
$mat = new materialController;
$ReciptNo = $_GET['ReciptNo'];
$result = $mat->staffCheckFeesbyRecept($ReciptNo);

$name = $result['fullname'];

$mobile = $result['mobile'];
$address = $result['address'];
$email = $result['email'];

//$Resultbank = $mat->SelectBanks($result['bank']);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="ThemeBucket">
        <link rel="shortcut icon" href="images/favicon.png">

        <title>Receipt No : - <?= $ReciptNo ?></title>
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
                    <div class="row">
                        <div class="col-md-12">
                            <section class="panel">
                                <div class="panel-body invoice">
                                    <div class="invoice-header">
                                        <div class="invoice-title col-md-3 col-xs-2">
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
                                                        Email : fashanzak@thewebaxis.com</p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="row invoice-to">
                                        <div class="col-md-4 col-sm-4 pull-left">
                                            <h4>Receipt To:</h4>
                                            <h2><?= $name ?></h2>
                                            <p>
                                                <?php
                                                if ($mobile != '') {
                                                    ?>Phone: <?= $mobile ?><br><?php
                                                }
                                                ?>
                                                <?php
                                                if ($address != '') {
                                                    ?>Address : <?= $address ?><br><?php
                                                }
                                                if ($email != '') {
                                                    ?>Email : <?= $email ?><?php
                                                }
                                                ?>

                                            </p>
                                        </div>
                                        <div class="col-md-4 col-sm-5 pull-right">
                                            <div class="row">
                                                <div class="col-md-4 col-sm-5 inv-label">Receipt </div>
                                                <div class="col-md-8 col-sm-7"><?= $ReciptNo ?></div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-4 col-sm-5 inv-label">Date </div>
                                                <div class="col-md-8 col-sm-7"><?= $result['payment_date'] ?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <table class="table table-invoice" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Payment Month</th>
                                                <th>Payment Year</th>
                                                <th style="text-align: right">Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$i = 1;
?>
                                            <tr>
                                                <td><?= $i ?></td>
                                                <td><?= $result['monthname'] ?></td>
                                                <td><?= $result['year'] ?></td>                                                                        
                                                <td style="text-align: right"><?= number_format($result['amount'], 2) ?></td>
                                            </tr>
<?php
$total = number_format($result['amount'], 2);
$i++;
?>
                                        </tbody>
                                    </table>
                                    <div class="row">
                                        <div class="col-md-8 col-xs-7 payment-method">                                
                                            <h3 class="inv-label itatic">Signature</h3>
                                        </div>
                                        <div class="col-md-4 col-xs-5 invoice-block pull-right">
                                            <ul class="unstyled amounts">
                                                <!--<li>Total amount : <?= $total ?></li>-->    
                                                <li class="grand-total">Grand Total : <?= $total ?></li>
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
<?php
$page = '';
if (isset($_GET['SecondPrint'])) {
    if ($_GET['SecondPrint'] == 'true') {
        $page = 'searchSalary';
    } else {
        $page = 'staffSalary';
    }
} else {
    $page = 'staffSalary';
}
?>
        //function doPrint() {
        //    window.print();            
        //    document.location.href = "<?= $page ?>"; 
        //}
        </script>
        <script>
            function doPrint() {
                window.print();
            }
            function getBack() {
                document.location.href = "studentAttendance";
            }
        </script>
        <button class="btn btn-warning" id="gotback" onclick="getBack()">Back</button>
    </body>
</html>
