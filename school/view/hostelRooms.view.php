<?php
session_start();
if (!isset($_SESSION['loguserid']))
    return header("location: login");
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;
$mat = new materialController;
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
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/brands.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/solid.js"></script>
        <script src="https://use.fontawesome.com/releases/v5.0.6/js/fontawesome.js"></script>
        <script src="/../public/ajax/header.js"></script>
        <script src="/../public/js/alertify.min.js"></script>
        <script src="/../public/js/jquery-ui.min.js"></script>
        <script data-pace-options='{ "ajax": false }' src="/../public/js/pace.js"></script>    
        <script src="/../public/js/jquery.validate.min.js"></script>
        <script src="/../public/js/bootstrap.min.js"></script>
        <script src="/../public/js/admin.min.js"></script>
        <script src="/../public/ajax/HostelRooms.js"></script>
        <link rel="stylesheet" href="/../public/css/select2.min.css">
        <script src="/../public/js/select2.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css">
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
                                    <h3 class="box-title">Hostel Rooms Related</h3>
                                </div>
                                <div class="box-body">
                                    <div class="col-md-12" id="editDates">
                                        <div class="nav-tabs-custom">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a href="#addhostelr" data-toggle="tab">Add Hostel Rooms</a></li>
                                                <li><a href="#list" data-toggle="tab">List</a></li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="active tab-pane" id="addhostelr">
                                                    <div class="post">
                                                        <div class="user-block">
                                                            <form method="post" id="hostelroomsReg" role="form">
                                                                <div class="row">
                                                                    <div class="col-lg-4">
                                                                        <div class="form-group">
                                                                            <label for="Hostel Type">Hostel Type</label>
                                                                            <select name="hosteltype" id="hosteltype" class="form-control select2" style="width: 100%;">
                                                                                <option value="">-- Select Hostel Type --</option>
                                                                                <?php
                                                                                $result1 = $mat->hostelsType();
                                                                                foreach ($result1 as $row) {
                                                                                    ?>
                                                                                    <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-4">
                                                                        <div id="hostelnameload"></div>                                                       
                                                                    </div>
                                                                    <div class="col-lg-4"></div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="floorname" name="floorname" placeholder="Enter Floor Name" autocomplete="off">
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="roomno" name="roomno" placeholder="Enter Room No" autocomplete="off">
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="noofbeds" name="noofbeds" placeholder="Enter No Of Beds" autocomplete="off">
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <input type="text" class="form-control" id="amount" name="amount" placeholder="Enter Amount" autocomplete="off">
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>                                                     
                                                                <div class="row">
                                                                    <div class="col-lg-12">  
                                                                        <a href="javascript:void(0)" style="background-color: #120082" class="btn btn-social-icon btn-bitbucket add" name="add" id="Addrooms"><i class="fa fa-plus-square"></i></a>   
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label for="Room No">Room No</label>
                                                                            <input type="text" class="form-control" id="RoomNo1" name="RoomNo1" placeholder="Enter Room No" autocomplete="off" readonly>
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label for="No Of Beds">No Of Beds</label>
                                                                            <input type="text" class="form-control" id="NoofBed1" name="NoofBed1" placeholder="Enter No Of Beds" autocomplete="off" readonly>
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-3">
                                                                        <div class="form-group">
                                                                            <label for="Room No">Rent Fees</label>
                                                                            <input type="text" class="form-control" id="RentAmount1" name="RentAmount1" placeholder="Enter Room No" autocomplete="off" readonly>
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" id="AddRoomDetails"></div>
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <label for="Fees Type">Fees Type</label>
                                                                            <select name="feetype" id="feetype" class="form-control select2" style="width: 100%;">
                                                                                <option value="">-- Select Type --</option>
                                                                                <option value="Annual">Annual</option>
                                                                                <option value="Bi-Annual">Bi-Annual</option>
                                                                                <option value="Tri-Annual">Tri-Annual</option>
                                                                                <option value="Quaterly">Quaterly</option>
                                                                                <option value="Monthly">Monthly</option>             
                                                                            </select>
                                                                            <span class="help-block" id="error"></span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row" id="loadFeeTypes"></div>
                                                                <div class="row col-lg-4">
                                                                    <div class="form-group" id="hidebuttonsave">
                                                                        <input type="hidden" name="countRooms" id="countRooms" value="1">
                                                                        <button type="submit" class="btn btn-warning" id="save" name="save">Save</button> 
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="tab-pane" id="list">
                                                    <div class="user-block">
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="table-responsive">
                                                                    <table class="table table-bordered table-striped" id="loadDetailsHostel" width="100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">#</th>
                                                                                <th scope="col">Hostel Type</th>
                                                                                <th scope="col">Hostel Name </th>
                                                                                <th scope="col">Floor Name</th>
                                                                                <th scope="col">Room No</th>
                                                                                <th scope="col">No Of Beds</th>
                                                                                <th scope="col">Room Rent</th>
                                                                                <th scope="col">Rent Fees</th>
                                                                                <th scope="col">Delete</th>
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

                var dataTable = $('#loadDetailsHostel').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "order": [],
                    "ajax": {
                        url: "getAllHostelRooms",
                        method: "POST"
                    },
                    "columnDefs": [
                        {
                            "targets": [0, 1, 2, 8],
                            "orderable": false
                        },
                    ],
                });

                $(document).on('click', '.deletex', function () {
                    var id = $(this).attr('id');
                    $.ajax({
                        url: "hostelsRoomsdelete",
                        method: "POST",
                        data: {id: id},
                        success: function ()
                        {
                            dataTable.ajax.reload();
                        }
                    });
                });
            });
            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $.ajax({
                    url: "UpdateHostelFeesDates",
                    method: "POST",
                    data: {id: id},
                    success: function (jsonData)
                    {
                        $('#editDates').html("");
                        $('#editDates').html(jsonData);
                    }
                });
            });
            $(document).on('change', '#hosteltype', function () {
                var hosteltype = $('#hosteltype').val();
                $.ajax({
                    url: "getHostelName",
                    method: "POST",
                    data: {hosteltype: hosteltype},
                    success: function (jsonData)
                    {
                        $('#hostelnameload').html(jsonData);
                    }
                });
            });

            $(document).on('click', '#Addrooms', function () {
                var roomNo = new Array();
                var NoOfBed = new Array();
                var RoomRent = new Array();

                num_rows = parseInt(document.getElementById("countRooms").value);
                totalrows = num_rows + 1;

                for (i = 2; i <= totalrows; i++)
                {
                    roomNo[i] = document.getElementById("RoomNo"+(i-1)).value;
                    NoOfBed[i] = document.getElementById("NoofBed"+(i-1)).value;
                    RoomRent[i] = document.getElementById("RentAmount"+(i-1)).value;
                }

                document.getElementById("AddRoomDetails").innerHTML = "";
                var tech = '';

                for (i = 2; i <= totalrows; i++)
                {
                    if (i === totalrows)
                    {                        
                        tech += '<div class="form-group col-md-3"><input type="text" class="form-control" id="RoomNo' + i + '" name="RoomNo' + i + '" readonly value="' + roomNo[i] + '"></div>';

                        tech += '<div class="form-group col-md-3"><input type="text" class="form-control" id="NoofBed' + i + '" name="NoofBed' + i + '" readonly value="' + NoOfBed[i] + '" ></div>';

                        tech += '<div class="form-group col-md-3"><input type="text" class="form-control" id="RentAmount' + i + '" name="RentAmount' + i + '" readonly value="' + RoomRent[i] + '"></div>';

                        tech += '<div class="form-group col-md-3 btn-group"><button type="button" class="btn btn-danger" id="deleteRenting' + i + '" ><i onclick="javascript:deleteRent(' + i + ')" class="fa fa-window-close"></i></button></div>';                        
                    }
                    else
                    {
                        tech += '<div class="form-group col-md-3"><input type="text" class="form-control" id="RoomNo' + i + '" name="RoomNo' + i + '" value="' + roomNo[i] + '" readonly></div>';

                        tech += '<div class="form-group col-md-3"><input type="text" class="form-control"  id="NoofBed' + i + '" value="' + NoOfBed[i] + '" name="NoofBed' + i + '" readonly></div>';

                        tech += '<div class="form-group col-md-3"><input type="text" class="form-control"  id="RentAmount' + i + '" value="' + RoomRent[i] + '" name="RentAmount' + i + '" readonly></div>';

                        tech += '<div class="form-group col-md-3 btn-group"><button type="button" class="btn btn-danger" id="deleteRenting' + i + '" ><i onclick="javascript:deleteRent(' + i + ')" class="fa fa-window-close"></i></button></div>';
                    }
                }



                tech += "";
                document.getElementById("AddRoomDetails").innerHTML = tech;
                document.getElementById("countRooms").value = totalrows;
            });
            
            function deleteRent(row)
            {
                var roomNo = new Array();
                var NoOfBed = new Array();
                var RoomRent = new Array();

                num_rows = parseInt(document.getElementById("countRooms").value);
                int_num_rows = num_rows;
                row = parseInt(row);

                k = 2;
                m = k;

                for (; k <= int_num_rows; k++)
                {
                    if (k == row) {

                    }
                    else
                    {
                        roomNo[m] = document.getElementById("RoomNo"+(k)).value;
                        NoOfBed[m] = document.getElementById("NoofBed"+(k)).value;
                        RoomRent[m] = document.getElementById("RentAmount"+(k)).value;
                        m++;
                    }
                }
                document.getElementById("AddRoomDetails").innerHTML = "";
                tech = '';
                i = 2;
                j = i;

                for (; i <= int_num_rows; i++)
                {
                    if (i == row) {

                    }
                    else
                    {
                        tech += '<div class="form-group col-md-3"><input type="text" class="form-control" id="RoomNo' + j + '" name="RoomNo' + j + '" value="' + roomNo[j] + '" readonly></div>';

                        tech += '<div class="form-group col-md-3"><input type="text" class="form-control"  id="NoofBed' + j + '" name="NoofBed' + j + '" value="' + NoOfBed[j] + '" readonly></div>';

                        tech += '<div class="form-group col-md-3"><input type="text" class="form-control"  id="RentAmount' + j + '" name="RentAmount' + j + '" value="' + RoomRent[j] + '" readonly></div>';

                        tech += '<div class="form-group col-md-2 btn-group"><button type="button" class="btn btn-danger" id="deleteRenting' + j + '" onclick="javascript:deleteRent(' + j + ')"><i class="fa fa-window-close"></i></button></div>';

                        j++;
                    }
                }
                tech += "";
                document.getElementById("AddRoomDetails").innerHTML = tech;
                document.getElementById("countRooms").value = int_num_rows - 1;
            }
            $(document).on('keyup', '#roomno', function () {
                var roomno = $('#roomno').val();
                $('#RoomNo1').val(roomno);
            });
            $(document).on('keyup', '#noofbeds', function () {
                var noofbeds = $('#noofbeds').val();
                $('#NoofBed1').val(noofbeds);
            });
            $(document).on('keyup', '#amount', function () {
                var amount = $('#amount').val();
                $('#RentAmount1').val(amount);
            });
            $(document).on('change', '#feetype', function () {
                var feetype = $('#feetype').val();
                $.ajax({
                    url: "HostelFeesType",
                    method: "POST",
                    data: {feetype: feetype},
                    success: function (jsonData)
                    {
                        $('#loadFeeTypes').html(jsonData);
                    }
                });
            });
        </script>
    </body>
</html>