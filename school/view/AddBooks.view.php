<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;

date_default_timezone_set('Asia/Colombo');
$date = date('Y-m-d');
$year = date('Y');
$month = date('m');
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>School</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="/../public/css/bootstrap.min.css">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
        <link rel="shortcut icon" href="/../public/img/school.png">
        <script src="//code.jquery.com/jquery-1.12.4.js"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="/../public/ajax/logout.js"></script>
        <script src="/../public/js/jquery.min.js"></script>
        <link rel="stylesheet" href="/../public/css/jquery-confirm.min.css">
        <script src="/../public/js/jquery-confirm.min.js"></script>
        <link rel="stylesheet" href="/../public/css/admin.css">
        <link rel="stylesheet" href="/../public/css/_all-skins.min.css">
        <link rel="stylesheet" href="/../public/css/pace/themes/silver/pace-theme-minimal.css">
        <link rel="stylesheet" href="/../public/css/alertify.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

        <script src="/../public/ajax/header.js"></script>
        <script src="/../public/js/alertify.min.js"></script>
        <script src="/../public/js/jquery-ui.min.js"></script>
        <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
        <script src="/../public/js/jquery.validate.min.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/admin.min.js"></script>
        <script src="/../public/ajax/bank.js"></script>
        <script src="/../public/ajax/addbooks.js"></script>
        <link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
        <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
        <link rel="stylesheet" href="/../public/css/select2.min.css">
        <script src="/../public/js/select2.min.js"></script>
        <link rel="stylesheet" href="/../public/js/bootstrap-datepicker/css/datepicker.css">
        <script type="text/javascript" src="/../public/js/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    </head>
    <body class="hold-transition skin-blue sidebar-mini" id="bodytag">
        <div class="wrapper" >
            <?php
            $objpage->header();
            ?>
            <div class="content-wrapper" id="loadAllDetails">    
                <section class="content">
                    <div class="row">        
                        <div class="col-md-12">
                            <div class="box box-primary">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Add Books</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#addbooks" data-toggle="tab">Add Books</a></li>
                                                <li><a href="#blist" data-toggle="tab">Book List</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="addbooks">
                                                    <div class="post">
                                                        <div class="user-block">
                                                            <div class="row">
                                                                <form method="post" id="addbooksReg" role="form">
                                                                    <div class="col-lg-12">
                                                                        <div class="row">
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Purchase Date">Purchase Date</label>
                                                                                    <div class="input-group date">
                                                                                        <div class="input-group-addon">
                                                                                            <i class="fa fa-calendar"></i>
                                                                                        </div>
                                                                                        <input type="text" class="form-control pull-right" id="purchasedate" name="purchasedate" value="<?= $date ?>" readonly>
                                                                                    </div>
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Bill No">Bill No</label>
                                                                                    <input type="text" class="form-control" id="billno" name="billno" placeholder="Enter Bill No" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Book ISBN No">Book ISBN No</label>
                                                                                    <input type="text" class="form-control" id="isbnno" name="isbnno" placeholder="Enter Book ISBN No" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Book No">Book No</label>
                                                                                    <input type="text" class="form-control" id="bookno" name="bookno" placeholder="Enter Book No" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Title">Title</label>
                                                                                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Title" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Author">Author</label>
                                                                                    <input type="text" class="form-control" id="author" name="author" placeholder="Enter Author" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Edition">Edition</label>
                                                                                    <input type="text" class="form-control" id="edition" name="edition" placeholder="Enter Edition" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Book Category">Book Category</label>
                                                                                    <select name="bookcategory" id="bookcategory" class="form-control select2" style="width: 100%;">
                                                                                        <option value="">-- Select Category --</option>
                                                                                        <?php
                                                                                        $result = $mat->bookcategory();
                                                                                        foreach ($result as $row) {
                                                                                            ?>
                                                                                            <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                                                            <?php
                                                                                        }
                                                                                        ?>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Publisher">Publisher</label>
                                                                                    <input type="text" class="form-control" id="publisher" name="publisher" placeholder="Enter Publisher" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="No Of Copies">No Of Copies</label>
                                                                                    <input type="text" class="form-control" id="noofcopies" name="noofcopies" placeholder="Enter No Of Copies" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Shelf No">Shelf No</label>
                                                                                    <input type="text" class="form-control" id="shelfno" name="shelfno" placeholder="Enter Shelf No" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Book Position">Book Position</label>
                                                                                    <input type="text" class="form-control" id="bookposition" name="bookposition" placeholder="Enter Book Position" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Book Cost">Book Cost</label>
                                                                                    <input type="text" class="form-control" id="bookcost" name="bookcost" placeholder="Enter Book Cost" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Language">Language</label>
                                                                                    <input type="text" class="form-control" id="language" name="language" placeholder="Enter Language" autocomplete="off">
                                                                                    <span class="help-block" id="error"></span>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-4">
                                                                                <div class="form-group">
                                                                                    <label for="Book Condition">Book Condition</label>
                                                                                    <select name="bookconition" id="bookconition" class="form-control select2" style="width: 100%;">
                                                                                        <option value="">-- Select Option --</option>
                                                                                        <option value="As New">As New</option>
                                                                                        <option value="Fine">Fine</option>
                                                                                        <option value="Very Good">Very Good</option>
                                                                                        <option value="Good">Good</option>
                                                                                        <option value="Fair">Fair</option>
                                                                                        <option value="Poor">Poor</option>
                                                                                        <option value="Missing">Missing</option>
                                                                                        <option value="Lost">Lost</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-lg-3">
                                                                                <div class="form-group" id="hidebutton">
                                                                                    <button type="submit" class="btn btn-warning" id="create" name="create">Create</button>   
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="blist">
                                                    <div class="user-block">
                                                        <div class="box box-solid">
                                                            <div class="box-body">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="table-responsive">
                                                                            <table id="bookSListS" class="table table-bordered table-striped" width="100%">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <th>ISBN No</th>
                                                                                        <th>Book No</th>
                                                                                        <th>Title</th>
                                                                                        <th>Shelf No</th>
                                                                                        <th>Position No</th>
                                                                                        <th>Language</th>
                                                                                        <th>Status</th>
                                                                                        <th>Action</th>
                                                                                    </tr>
                                                                                </thead>
                                                                            </table>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>                        
                                            </div>                        
                                        </div>                      
                                    </div>
                                </div>
                            </div>
                        </div>            
                    </div>    
                </section>
            </div>
            <footer class="main-footer">
                <div class="pull-right hidden-xs">
                </div>
                <strong>Copyright &copy; 2019 <a href="https://www.linkedin.com/in/mohammed-fashan-a59092187/" target="_blank">Fashan</a>.</strong> All rights
                reserved.
            </footer>
            <div class="control-sidebar-bg"></div>
        </div>
        <script>
            $(document).ready(function () {
                $('.select2').select2();
                $('#purchasedate').datepicker({
                    format: 'yyyy-mm-dd'
                });
            });
            var dataTable = $('#bookSListS').DataTable({
                "processing": true,
                "serverSide": true,
                "order": [],
                "ajax": {
                    url: "getAllBooks",
                    method: "POST"
                },
                "columnDefs": [
                    {
                        "targets": [2, 3, 4, 5, 7],
                        "orderable": false
                    },
                ],
            });
            $(document).on('click', '.delete', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: "deleteSomeBooks",
                    method: "POST",
                    data: {id: id},
                    success: function (json)
                    {
                        dataTable.ajax.reload();
                    }
                });
            });
        </script>
    </body>
</html>