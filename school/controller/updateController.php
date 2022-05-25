<?php

class updateController {

    public function updateStaff() {
        $name = $_POST['name'];
        $value = $_POST['value'];
        $pk = $_POST['pk'];

        $table = 'staff_reg';
        $obj = new commonSql;

        $collect = $name . "= '$value' WHERE id = '$pk'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function updateStaffs() {
        if (isset($_POST['id'])) {
            $obj = new commonSql;

            $id = $_POST['id'];
            $value = $_POST['value'];
            $name = $_POST['column_name'];
            $collect = $name . "= '$value' WHERE id = '$id'";
            $table = 'staff_reg';

            $arr = array();
            $arr[0] = $collect;
            $obj->updation($table, $arr);
        }
    }

    public function updateStudent() {
        $name = $_POST['name'];
        $value = $_POST['value'];
        $pk = $_POST['pk'];

        $table = 'studentreg';
        $obj = new commonSql;

        $collect = $name . "= '$value' WHERE id = '$pk'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function UserRegUpdatePassword() {
        $newpassword = $_POST['npassword'];
        $newpassword = base64_encode($newpassword);
        $userid = $_SESSION['loguserid'];

        $table = 'user_reg';
        $obj = new commonSql;

        $collect = "password = '$newpassword' WHERE id = '$userid'";
        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function UserPrivilageUpdateDetails() {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $mobile = $_POST['mobile'];
        $dob = $_POST['dob'];
        $nic = $_POST['nic'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $usertype = $_POST['usertype'];
        $id = $_POST['userid'];

        $table = 'user_reg';
        $obj = new commonSql;

        $collect = "first_name = '$fname', last_name = '$lname', mobile = '$mobile', birthday = '$dob', nic = '$nic', email = '$email', address = '$address', usertype = '$usertype' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function UpdatePrivilagePage($sign, $id) {
        $table = 'user_priviledge';
        $obj = new commonSql;

        $collect = "viewstatus = '$sign' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        return $obj->updation($table, $arr);
    }

    public function updatestudentGrade() {
        $obj = new commonSql;

        $id = $_POST['uid'];
        $gradenumber = $_POST['gradenumber'];

        $collect1 = "grade = '$gradenumber' WHERE studentid = '$id'";
        $arrr = array();
        $arrr[0] = $collect1;
        $table1 = 'studentattendance';
        $obj->updation($table1, $arrr);

        $collect2 = "grade = '$gradenumber' WHERE student = '$id'";
        $arrrr = array();
        $arrrr[0] = $collect2;
        $table2 = 'fee_allocation';
        $obj->updation($table2, $arrrr);

        $table = 'studentreg';
        $collect = "grade = '$gradenumber' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function updategrades() {
        $name = $_POST['name'];
        $value = $_POST['value'];
        $pk = $_POST['pk'];

        $table = 'class_register';
        $obj = new commonSql;

        $collect = $name . "= '$value' WHERE id = '$pk'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function updateUsertype() {
        $name = $_POST['name'];
        $value = $_POST['value'];
        $pk = $_POST['pk'];

        $table = 'user_type';
        $obj = new commonSql;

        $collect = $name . "= '$value' WHERE id = '$pk'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function updateDepartment() {
        $name = $_POST['name'];
        $value = $_POST['value'];
        $pk = $_POST['pk'];

        $table = 'staff_department';
        $obj = new commonSql;

        $collect = $name . "= '$value' WHERE id = '$pk'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function updatebank() {
        $name = $_POST['name'];
        $value = $_POST['value'];
        $pk = $_POST['pk'];

        $table = 'banks';
        $obj = new commonSql;

        $collect = $name . "= '$value' WHERE id = '$pk'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function updateLeaveCategory() {
        $name = $_POST['name'];
        $value = $_POST['value'];
        $pk = $_POST['pk'];

        $table = 'leave_category';
        $obj = new commonSql;

        $collect = $name . "= '$value' WHERE id = '$pk'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function updateLeaveDetails() {
        $name = $_POST['name'];
        $value = $_POST['value'];
        $pk = $_POST['pk'];

        $table = 'leave_detail_category';
        $obj = new commonSql;

        $collect = $name . "= '$value' WHERE id = '$pk'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function bookCategoryUpdate() {
        $id = $_POST['cid'];
        $categoryname = $_POST['categorynameupd'];
        $sectioncode = $_POST['sectioncodeupd'];
        $table = 'book_category';
        $obj = new commonSql;

        $collect = "name = '$categoryname', code = '$sectioncode' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function UpdatebookCopies($id, $copies) {
        $table = 'librarybooks';
        $obj = new commonSql;

        $collect = "no_of_copies = '$copies' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function UpdatebookStatus($id) {
        $table = 'librarybooks_child';
        $obj = new commonSql;

        $collect = "status = 'issued' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        return $obj->updation($table, $arr);
    }

    public function updateIssuedBook() {
        $mat = new materialController;
        $obj = new commonSql;
        $returnrenewal = $_POST['returnrenewal'];
        $childLibrary = $_POST['childTbID'];
        $result = $mat->getDetailsIssuedBook($childLibrary);
        if ($returnrenewal == 'return') {
            $fineamount = $_POST['fineamount'];
            $returndate = $_POST['returndate'];
            $remarks = $_POST['remarks'];

            if (empty($fineamount)) {
                $fineamount = 0;
            }

            $table = "issue_books ";
            $collect = "status = 'closed', fine = '$fineamount', return_date = '$returndate', remarks = '$remarks' WHERE id = '{$result['id']}'";
            $arr = array();
            $arr[0] = $collect;

            if ($obj->updation($table, $arr) == 1) {
                echo "ok";
            } else {
                echo "notok";
            }

            $collect1 = "status = 'Available' WHERE id = '$childLibrary'";
            $table1 = "librarybooks_child";
            $arr1 = array();
            $arr1[0] = $collect1;
            $obj->updation($table1, $arr1);
        } else if ($returnrenewal == 'renewal') {
            $resultO = $mat->getissuedBookbId($result['id']);
            $getDueDate = $resultO['due_date'];

            $tbl = "issue_books ";
            $collect = "status = 'closed', fine = '0', return_date = '$getDueDate' WHERE id = '{$result['id']}'";
            $arr = array();
            $arr[0] = $collect;

            $obj->updation($tbl, $arr);

            $data = array(
                "childTbID" => $_POST['childTbID'],
                "bookno_title" => $resultO['bookno_title'],
                "usertype" => $resultO['usertype'],
                "user" => $resultO['user'],
                "issue_date" => $getDueDate,
                "due_date" => $_POST['duedate'],
                "fine" => 0,
                "status" => "issued",
                "return_date" => "",
                "active" => "yes",
                "id" => "",
                "remarks" => ""
            );
            if ($obj->insertion("issue_books", $data) == 1) {
                echo "ok";
            } else {
                echo "notok";
            }
        }
    }

    public function hosteltypeUpdate() {
        $table = 'hostel_type';
        $id = $_POST['htypeid'];
        $name = $_POST['hosteltypeupd'];
        $obj = new commonSql;

        $collect = "name = '$name' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function hostelUpdate() {
        $id = $_POST['hostelid'];
        $hosteltype = $_POST['hosteltypeupd'];
        $hostelname = $_POST['hostelnameupd'];
        $hosteladdr = $_POST['hosteladdrupd'];
        $hostelpno = $_POST['hostelpnoupd'];
        $wardenname = $_POST['wardennameupd'];
        $wardenaddr = $_POST['wardenaddrupd'];
        $wardenpno = $_POST['wardenpnoupd'];
        $active = "yes";
        $table = 'hostels_details';

        $obj = new commonSql;

        $collect = "hostel_type = '$hosteltype', hostel_name= '$hostelname', hostel_address = '$hosteladdr', hostel_pno = '$hostelpno', warden_name = '$wardenname', warden_address = '$wardenaddr', warden_pno = '$wardenpno' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function HostelMemberUpdateTransfer() {
        $obj = new commonSql;
        $mat = new materialController;
        $vad = new validationController;
        $usertype = $_POST['usertype'];
        $option = $_POST['optionofEdit'];

        date_default_timezone_set('Asia/Colombo');
        $date = date('Y-m-d');
        $year = date('Y');
        $month = date('m');

        if ($usertype == 'student') {
            if ($_POST['studentid'] != '') {
                $userid = $_POST['studentid'];
                $result = $mat->hostelRoomByUser($userid, $usertype);
                $idofhostelmem_reg = $result['id'];
                $roomid = $result['hostel_room'];
                $counting = $vad->hostelRoomsCountVacateUsers($userid, $usertype, $roomid);
                $userCounting = $mat->CountSingleMemberRooms($userid, $usertype);

                if ($userCounting > 0) {
                    if ($option == 'Transfer') {
                        if ($counting > 0) {
                            echo "vacateErrTrans";
                        } else {
                            $hosteltype = $_POST['hosteltype'];
                            $hostelname = $_POST['hostelname'];
                            $hostelroomID = $_POST['hostelroomID'];
                            if ($hostelroomID != $roomid) {
                                //Previous Floor Room No And Hostel Room
                                $resultHotelRooms = $mat->hostelRoomsDetails($roomid);
                                $statusAvailable = '';
                                $allocatedbed = $resultHotelRooms['allocated_bed'] - 1;
                                $availablebeds = $resultHotelRooms['available_beds'] + 1;
                                if ($availablebeds > 0) {
                                    $statusAvailable = 'Available';
                                } else {
                                    $statusAvailable = 'Closed';
                                }
                                $collect = "available_beds = '$availablebeds', allocated_bed = '$allocatedbed', status = '$statusAvailable' WHERE id = '$roomid'";
                                $arr = array();
                                $arr[0] = $collect;
                                $table1 = 'hostel_rooms'; //update beds
                                $obj->updation($table1, $arr);

                                //Previous Updation Closed
                                //New Floor Room No And Hostel Room
                                $resultRooms = $mat->hostelRoomsDetails($hostelroomID); //getting details 
                                $newAvailableBeds = $resultRooms['available_beds'] - 1;
                                $newAllocatedBeds = $resultRooms['allocated_bed'] + 1;
                                $newStatusAvailable = '';
                                if ($newAvailableBeds > 0) {
                                    $newStatusAvailable = 'Available';
                                } else {
                                    $newStatusAvailable = 'Closed';
                                }
                                $collect1 = "available_beds = '$newAvailableBeds', allocated_bed = '$newAllocatedBeds', status = '$newStatusAvailable' WHERE id = '$hostelroomID'";
                                $arr1 = array();
                                $arr1[0] = $collect1;  //update beds
                                $obj->updation($table1, $arr1);
                                //New Updation Done

                                $collect2 = "hostel_type = '$hosteltype', hostel_name = '$hostelname', hostel_room = '$hostelroomID' WHERE id = '$idofhostelmem_reg'";
                                $arr2 = array();
                                $arr2[0] = $collect2;
                                $table2 = 'hostelmem_reg'; //update beds
                                if ($obj->updation($table2, $arr2) == 1)
                                    echo "ok";
                                else
                                    echo "notok";
                            }
                            else {
                                echo "oops";
                            }
                        }
                    } else if ($option == 'Vacate') {

                        if ($counting > 0) {
                            echo "vacateErr";
                        } else {
                            $resultHotelRooms = $mat->hostelRoomsDetails($roomid);
                            $statusAvailable = '';
                            $allocatedbed = $resultHotelRooms['allocated_bed'] - 1;
                            $availablebeds = $resultHotelRooms['available_beds'] + 1;
                            if ($availablebeds > 0) {
                                $statusAvailable = 'Available';
                            } else {
                                $statusAvailable = 'Closed';
                            }
                            $collect = "available_beds = '$availablebeds', allocated_bed = '$allocatedbed', status = '$statusAvailable' WHERE id = '$roomid'";
                            $arr = array();
                            $arr[0] = $collect;
                            $table1 = 'hostel_rooms'; //update beds
                            $obj->updation($table1, $arr);

                            $collect2 = "vacate_date = '$date', status = 'vacate' WHERE id = '$idofhostelmem_reg'";
                            $arr2 = array();
                            $arr2[0] = $collect2;
                            $table2 = 'hostelmem_reg'; //update beds
                            if ($obj->updation($table2, $arr2) == 1)
                                echo "ok";
                            else
                                echo "notok";
                        }
                    }
                }
                else {
                    echo "notfound";
                }
            } else {
                echo "miss";
            }
        } else if ($usertype == 'employee') {
            if ($_POST['staffid'] != '') {
                $userid = $_POST['staffid'];
                $result = $mat->hostelRoomByUser($userid, $usertype);
                $idofhostelmem_reg = $result['id'];
                $roomid = $result['hostel_room'];
                $counting = $vad->hostelRoomsCountVacateUsers($userid, $usertype, $roomid);
                $userCounting = $mat->CountSingleMemberRooms($userid, $usertype);

                if ($userCounting > 0) {
                    if ($option == 'Transfer') {
                        if ($counting > 0) {
                            echo "vacateErrTrans";
                        } else {
                            $hosteltype = $_POST['hosteltype'];
                            $hostelname = $_POST['hostelname'];
                            $hostelroomID = $_POST['hostelroomID'];
                            if ($hostelroomID != $roomid) {
                                //Previous Floor Room No And Hostel Room
                                $resultHotelRooms = $mat->hostelRoomsDetails($roomid);
                                $statusAvailable = '';
                                $allocatedbed = $resultHotelRooms['allocated_bed'] - 1;
                                $availablebeds = $resultHotelRooms['available_beds'] + 1;
                                if ($availablebeds > 0) {
                                    $statusAvailable = 'Available';
                                } else {
                                    $statusAvailable = 'Closed';
                                }

                                $collect = "available_beds = '$availablebeds', allocated_bed = '$allocatedbed', status = '$statusAvailable' WHERE id = '$roomid'";
                                $arr = array();
                                $arr[0] = $collect;
                                $table1 = 'hostel_rooms'; //update beds
                                $obj->updation($table1, $arr);

                                //Previous Updation Closed
                                //New Floor Room No And Hostel Room
                                $resultRooms = $mat->hostelRoomsDetails($hostelroomID); //getting details 
                                $newAvailableBeds = $resultRooms['available_beds'] - 1;
                                $newAllocatedBeds = $resultRooms['allocated_bed'] + 1;
                                $newStatusAvailable = '';
                                if ($newAvailableBeds > 0) {
                                    $newStatusAvailable = 'Available';
                                } else {
                                    $newStatusAvailable = 'Closed';
                                }
                                $collect1 = "available_beds = '$newAvailableBeds', allocated_bed = '$newAllocatedBeds', status = '$newStatusAvailable' WHERE id = '$hostelroomID'";
                                $arr1 = array();
                                $arr1[0] = $collect1;  //update beds
                                $obj->updation($table1, $arr1);
                                //New Updation Done

                                $collect2 = "hostel_type = '$hosteltype', hostel_name = '$hostelname', hostel_room = '$hostelroomID' WHERE id = '$idofhostelmem_reg'";
                                $arr2 = array();
                                $arr2[0] = $collect2;
                                $table2 = 'hostelmem_reg'; //update beds
                                if ($obj->updation($table2, $arr2) == 1)
                                    echo "ok";
                                else
                                    echo "notok";
                            }
                            else {
                                echo "oops";
                            }
                        }
                    } else if ($option == 'Vacate') {
                        if ($counting > 0) {
                            echo "vacateErr";
                        } else {
                            $resultHotelRooms = $mat->hostelRoomsDetails($roomid);
                            $statusAvailable = '';
                            $allocatedbed = $resultHotelRooms['allocated_bed'] - 1;
                            $availablebeds = $resultHotelRooms['available_beds'] + 1;
                            if ($availablebeds > 0) {
                                $statusAvailable = 'Available';
                            } else {
                                $statusAvailable = 'Closed';
                            }
                            $collect = "available_beds = '$availablebeds', allocated_bed = '$allocatedbed', status = '$statusAvailable' WHERE id = '$roomid'";
                            $arr = array();
                            $arr[0] = $collect;
                            $table1 = 'hostel_rooms'; //update beds
                            $obj->updation($table1, $arr);

                            $collect2 = "vacate_date = '$date', status = 'vacate' WHERE id = '$idofhostelmem_reg'";
                            $arr2 = array();
                            $arr2[0] = $collect2;
                            $table2 = 'hostelmem_reg'; //update beds
                            if ($obj->updation($table2, $arr2) == 1)
                                echo "ok";
                            else
                                echo "notok";
                        }
                    }
                }
                else {
                    echo "notfound";
                }
            } else {
                echo "miss";
            }
        }
    }

    public function updateLeaveofStaff() {
        $obj = new commonSql;
        $mat = new materialController;
        $vad = new validationController;
        $id = $_POST['id'];


        $resultPro = $mat->getSingleChildleaveApp($id);
        $mainResult = $mat->SelectdetailLeaveCate($resultPro['parent_app']);

        $collect1 = "status = 'Close' WHERE id = '{$resultPro['parent_app']}'";



        $collect = "status = 'Approved' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        $table = 'leave_application_child';
        if ($obj->updation($table, $arr) == 1) {
            $arr1 = array();
            $arr1[0] = $collect1;
//            $obj->updation("leave_application", $arr1);
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function updaterejectLeaveofStaff() {
        $obj = new commonSql;
        $mat = new materialController;
        $vad = new validationController;
        $id = $_POST['id'];


        $resultPro = $mat->getSingleChildleaveApp($id);
        $mainResult = $mat->SelectdetailLeaveCate($resultPro['parent_app']);


        $remainingLeave = $resultPro['count_leaves'] + $mainResult['remaining_leave'];

        $collect = "status = 'Reject' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        $table = 'leave_application_child';
        if ($obj->updation($table, $arr) == 1)
            echo "ok";
        else
            echo "notok";

        $collect1 = "remaining_leave = '$remainingLeave', status = 'Open' WHERE id = '{$resultPro['parent_app']}'";
        $arr1 = array();
        $arr1[0] = $collect1;
        $table1 = 'leave_application';
        $obj->updation($table1, $arr1);
    }

    public function feeCategoryUpdate() {
        $table = 'fee_category';
        $id = $_POST['feesid'];
        $feecategoryupd = $_POST['feecategoryupd'];
        $prefixreciptnoupd = $_POST['prefixreciptnoupd'];
        $descriptionupd = $_POST['descriptionupd'];
        $obj = new commonSql;

        $collect = "category_name = '$feecategoryupd', prefix = '$prefixreciptnoupd', description = '$descriptionupd' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function FeesListUpdate() {
        $obj = new commonSql;
        $bool = '';
        $totalCOunt = $_POST['totalCOunt'];
        for ($i = 1; $i < $totalCOunt; $i++) {
            $startdate = $_POST['startdate' . $i];
            $duedate = $_POST['duedate' . $i];
            $enddate = $_POST['enddate' . $i];
            $id = $_POST['feestypeid' . $i];
            $collect = "start_date = '$startdate', due_date = '$duedate', end_date = '$enddate' WHERE id = '$id'";
            $table = "fees_types";
            $arr[0] = $collect;
            if ($obj->updation($table, $arr) == 1) {
                $bool = "ok";
            } else {
                $bool = "notok";
            }
        }
        echo $bool;
    }

    public function StudentsFeesCollectionUpdate() {
        $mat = new materialController;
        $obj = new commonSql;
        $table = 'studentfee_pay';

        $rowmaxreciptId = $mat->getMaxTotalInvoice();
        if ($rowmaxreciptId == '0') {
            $reciptIdTotal = '0001';
        } else {
            $incrementorder = intval($rowmaxreciptId) + 1;
            $reciptIdTotal = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
        }

        $gradenumberlist = '';
        $studentid = '';
        $modeofpay = $_POST['modeofpay'];
        $banknameload = '';
        $chequeno = '';
        $chequedate = '';
        $TotalAmount = $_POST['TotalAmount'];
        $remarks = $_POST['remarks'];
        $paydate = $_POST['paydate'];
        $active = 'yes';
        $id = '';
        $countList = $_POST['countList'];
        $bool = '';

        if ($_POST['SearchStudent'] != '') {
            $studentid = $_POST['studentid'];
        }

        $studentResult = $mat->SelectStudentbyid($studentid);

        if ($_POST['gradenumberlist'] != '') {
            $gradenumberlist = $_POST['gradenumberlist'];
            $studentid = $_POST['students'];
        } else {
            $gradenumberlist = $studentResult['grade'];
        }

        if ($modeofpay == 'cheque') {
            $banknameload = $_POST['banknameload'];
            $chequeno = $_POST['chequeno'];
            $chequedate = $_POST['chequedate'];
        }

        for ($i = 1; $i < $countList; $i++) {
            if (isset($_POST['checkboxSelect' . $i])) {
                $subCategoryId = $_POST['subcatid' . $i];

                $feeSubCatResult = $mat->getSubcategoryFee($subCategoryId);
                $result1 = $mat->feeAllocationListP1($gradenumberlist, $studentid);
                $rowFeemainCategory = $mat->SelectFeeCategory($feeSubCatResult['fee_category']);
                $prefix = $rowFeemainCategory['prefix'];
                $rowmaxreciptId1 = $mat->getMaxInvoiceofFeepay($subCategoryId);
                if ($rowmaxreciptId1 == '0') {
                    $reciptId1 = '0001';
                } else {
                    $incrementorder = intval($rowmaxreciptId1) + 1;
                    $reciptId1 = str_pad($incrementorder, 4, '0', STR_PAD_LEFT);
                }

                $installment = $_POST['installment' . $i];

                $y = 1;
                $res = $mat->StudentFeePayP1($studentid, $subCategoryId);
                $payamount = $_POST['payamount' . $i];
                $fine = $_POST['fine' . $i];
                $discount = $_POST['discount' . $i];

                foreach ($res as $re) {
                    $individualBalance = 0;
                    $statusPaid = '';
                    $feepayid = $_POST['feepayid' . $y];


                    if ($payamount < $_POST['amount' . $i]) {
                        $individualBalance = $_POST['amount' . $i] - $payamount;
                        $statusPaid = 'notpaid';
                        $totalcal = $payamount + $fine - $discount;
                        if ($installment == '') {
                            $collect = "pay_date = '$paydate', payamount = '$payamount', balance_amount = '$individualBalance', total_amount = '$totalcal', fine = '$fine', discount = '$discount', prefix = '$prefix', indvidual_receipt = '$reciptId1', receipt_no = '$reciptIdTotal', modeof_pay = '$modeofpay', bank = '$banknameload', chequeno = '$chequeno', chequedate = '$chequedate', totalamount = '$TotalAmount', remarks = '$remarks', status = '$statusPaid' WHERE id = '$feepayid'";
                            $arr = array();
                            $arr[0] = $collect;
                            if ($obj->updation($table, $arr) == 1) {
                                $bool = $reciptIdTotal;
                            } else {
                                $bool = "notok";
                            }
                        } else if ($installment != '') {
                            $collect = "pay_date = '$paydate', payamount = '$payamount', balance_amount = '$individualBalance', total_amount = '$totalcal', fine = '$fine', discount = '$discount', prefix = '$prefix', indvidual_receipt = '$reciptId1', receipt_no = '$reciptIdTotal', modeof_pay = '$modeofpay', bank = '$banknameload', chequeno = '$chequeno', chequedate = '$chequedate', totalamount = '$TotalAmount', remarks = '$remarks', status = '$statusPaid' WHERE id = '$feepayid' AND feetype_id = '$installment'";
                            $arr = array();
                            $arr[0] = $collect;
                            if ($obj->updation($table, $arr) == 1) {
                                $bool = $reciptIdTotal;
                            } else {
                                $bool = "notok";
                            }
                        }
                        break;
                    } else {
                        if ($payamount >= $_POST['amount' . $i]) {
                            $individualBalance = $payamount - $_POST['amount' . $i];
                            $Currentpaying = $_POST['amount' . $i];
                            $actualbalance = 0;
                            $statusPaid = 'paid';

                            $totalcal = $Currentpaying + $fine - $discount;
                            if ($installment == '') {
                                $collect = "pay_date = '$paydate', payamount = '$Currentpaying', balance_amount = '$actualbalance', total_amount = '$totalcal', fine = '$fine', discount = '$discount', prefix = '$prefix', indvidual_receipt = '$reciptId1', receipt_no = '$reciptIdTotal', modeof_pay = '$modeofpay', bank = '$banknameload', chequeno = '$chequeno', chequedate = '$chequedate', totalamount = '$TotalAmount', remarks = '$remarks', status = '$statusPaid' WHERE id = '$feepayid'";
                                $arr = array();
                                $arr[0] = $collect;
                                if ($obj->updation($table, $arr) == 1) {
                                    $bool = $reciptIdTotal;
                                } else {
                                    $bool = "notok";
                                }
                            } else if ($installment != '') {
                                $collect = "pay_date = '$paydate', payamount = '$Currentpaying', balance_amount = '$actualbalance', total_amount = '$totalcal', fine = '$fine', discount = '$discount', prefix = '$prefix', indvidual_receipt = '$reciptId1', receipt_no = '$reciptIdTotal', modeof_pay = '$modeofpay', bank = '$banknameload', chequeno = '$chequeno', chequedate = '$chequedate', totalamount = '$TotalAmount', remarks = '$remarks', status = '$statusPaid' WHERE id = '$feepayid' AND feetype_id = '$installment'";
                                $arr = array();
                                $arr[0] = $collect;
                                if ($obj->updation($table, $arr) == 1) {
                                    $bool = $reciptIdTotal;
                                } else {
                                    $bool = "notok";
                                }
                            }

                            $payamount = $individualBalance;
                        } else {
                            if ($payamount > $_POST['amount' . $i]) {
                                $actualbalance = $payamount - $_POST['amount' . $i];
                            } else {
                                $actualbalance = $_POST['amount' . $i] - $payamount;
                            }
                            $statusPaid = 'notpaid';
                            $totalcal = $payamount + $fine - $discount;
                            if ($installment == '') {
                                $collect = "pay_date = '$paydate', payamount = '$payamount', balance_amount = '$actualbalance', total_amount = '$totalcal', fine = '$fine', discount = '$discount', prefix = '$prefix', indvidual_receipt = '$reciptId1', receipt_no = '$reciptIdTotal', modeof_pay = '$modeofpay', bank = '$banknameload', chequeno = '$chequeno', chequedate = '$chequedate', totalamount = '$TotalAmount', remarks = '$remarks', status = '$statusPaid' WHERE id = '$feepayid'";
                                $arr = array();
                                $arr[0] = $collect;
                                if ($obj->updation($table, $arr) == 1) {
                                    $bool = $reciptIdTotal;
                                } else {
                                    $bool = "notok";
                                }
                            } else if ($installment != '') {
                                $collect = "pay_date = '$paydate', payamount = '$payamount', balance_amount = '$actualbalance', total_amount = '$totalcal', fine = '$fine', discount = '$discount', prefix = '$prefix', indvidual_receipt = '$reciptId1', receipt_no = '$reciptIdTotal', modeof_pay = '$modeofpay', bank = '$banknameload', chequeno = '$chequeno', chequedate = '$chequedate', totalamount = '$TotalAmount', remarks = '$remarks', status = '$statusPaid' WHERE id = '$feepayid' AND feetype_id = '$installment'";
                                $arr = array();
                                $arr[0] = $collect;
                                if ($obj->updation($table, $arr) == 1) {
                                    $bool = $reciptIdTotal;
                                } else {
                                    $bool = "notok";
                                }
                            }
                        }
                    }
                    $y++;
                }
            }
        }
        echo $bool;
    }

    public function VehicleeUpdate() {
        $vehicleno1Upd = $_POST['vehicleno1Upd'];
        $vehicleno2Upd = $_POST['vehicleno2Upd'];
        $id = $_POST['vehicleid'];
        $vehicle = $_POST['vehicleno1Upd'] . "-" . $_POST['vehicleno2Upd'];
        $noofseatsUpd = $_POST['noofseatsUpd'];
        $maximumallowedUpd = $_POST['maximumallowedUpd'];
        $vehicletypeUpd = $_POST['vehicletypeUpd'];
        $contactpersonUpd = $_POST['contactpersonUpd'];
        $insurancerenewalUpd = $_POST['insurancerenewalUpd'];
        $trackidUpd = $_POST['trackidUpd'];

        $obj = new commonSql;
        $table = 'vehicle_reg';

        $collect = "firstno = '$vehicleno1Upd', secondno = '$vehicleno2Upd', vehicle_no = '$vehicle', no_of_seats = '$noofseatsUpd', maximum_allo = '$maximumallowedUpd', vehicle_type = '$vehicletypeUpd', contact_person = '$contactpersonUpd', renew_date = '$insurancerenewalUpd', track_id = '$trackidUpd' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function VehicleeDriverUpdate() {
        $vehicleUpd = $_POST['vehicleUpd'];
        $drivernameUpd = $_POST['drivernameUpd'];
        $caddressUpd = $_POST['caddressUpd'];
        $paddressUpd = $_POST['paddressUpd'];
        $dobUpd = $_POST['dobUpd'];
        $PhoneUpd = $_POST['PhoneUpd'];
        $licenseUpd = $_POST['licenseUpd'];
        $id = $_POST['driverid'];

        $obj = new commonSql;
        $table = 'vehicle_drive';

        $collect = "vehicle = '$vehicleUpd', name = '$drivernameUpd', c_address = '$caddressUpd', p_address = '$paddressUpd', dob = '$dobUpd', phone = '$PhoneUpd', licence_no = '$licenseUpd' WHERE id = '$id'";

        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function HostelFeesListUpdate() {
        $obj = new commonSql;
        $bool = '';
        $totalCOunt = $_POST['totalCOunt'];
        for ($i = 1; $i < $totalCOunt; $i++) {
            $startdate = $_POST['startdate' . $i];
            $duedate = $_POST['duedate' . $i];
            $enddate = $_POST['enddate' . $i];
            $id = $_POST['feestypeid' . $i];
            $collect = "start_date = '$startdate', due_date = '$duedate', end_date = '$enddate' WHERE id = '$id'";
            $table = "hostel_fees";
            $arr[0] = $collect;
            if ($obj->updation($table, $arr) == 1) {
                $bool = "ok";
            } else {
                $bool = "notok";
            }
        }
        echo $bool;
    }

    public function AddRouteUpdate() {
        $vehicleUpd = $_POST['vehicleUpd'];
        $routecodeUpd = $_POST['routecodeUpd'];
        $routestartplaceUpd = $_POST['routestartplaceUpd'];
        $routestopplaceUpd = $_POST['routestopplaceUpd'];
        $id = $_POST['routeid'];

        $obj = new commonSql;
        $table = 'vehicle_route';

        $collect = "vehicle = '$vehicleUpd', r_code = '$routecodeUpd', start_place = '$routestartplaceUpd', stop_place = '$routestopplaceUpd' WHERE id = '$id'";

        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function VehicleeDestinationUpd() {
        $routecodeUpd = $_POST['routecodeUpd'];
        $pickupanddropUpd = $_POST['pickupanddropUpd'];
        $stoptimeUpd = $_POST['stoptimeUpd'];
        $amountUpd = $_POST['amountUpd'];
        $destid = $_POST['destid'];

        $obj = new commonSql;
        $table = 'destination';

        $collect = "r_code = '$routecodeUpd', pick_drop = '$pickupanddropUpd', stop_time = '$stoptimeUpd', amount = '$amountUpd' WHERE id = '$destid'";

        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function FeesListDestinationUpdate() {
        $obj = new commonSql;
        $bool = '';
        $totalCOunt = $_POST['totalCOunt'];
        for ($i = 1; $i < $totalCOunt; $i++) {
            $startdate = $_POST['startdate' . $i];
            $duedate = $_POST['duedate' . $i];
            $enddate = $_POST['enddate' . $i];
            $id = $_POST['destinationfeestypeid' . $i];
            $collect = "start_date = '$startdate', due_date = '$duedate', end_date = '$enddate' WHERE id = '$id'";
            $table = "destination_fees";
            $arr[0] = $collect;
            if ($obj->updation($table, $arr) == 1) {
                $bool = "ok";
            } else {
                $bool = "notok";
            }
        }
        echo $bool;
    }

    public function TransportAllocationUpdate() {

        //usertypeman grade students staff     
        $id = $_POST['destinationMan'];
        $routecodeMan = $_POST['routecodeMan'];
        $destinationMMan = $_POST['destinationMMan'];
        $sFrequencyMan = $_POST['sFrequencyMan'];
        $eFrequencyMan = $_POST['eFrequencyMan'];

        $obj = new commonSql;
        $table = 'transport_allocation';

        $collect = "route = '$routecodeMan', destination = '$destinationMMan', s_frequency = '$sFrequencyMan', e_frequency = '$eFrequencyMan' WHERE id = '$id'";

        $arr = array();
        $arr[0] = $collect;
        if ($obj->updation($table, $arr) == 1) {
            echo "ok";
        } else {
            echo "notok";
        }
    }

    public function updateloadbranch() {
        $name = $_POST['name'];
        $value = $_POST['value'];
        $pk = $_POST['pk'];

        $table = 'branch';
        $obj = new commonSql;

        $collect = $name . "= '$value' WHERE id = '$pk'";
        $arr = array();
        $arr[0] = $collect;
        $obj->updation($table, $arr);
    }

    public function ConfirmExamPublish() {
        $table = 'tbl_exam_paper';
        $obj = new commonSql;
        $paper = $_POST['paper'];

        $collect = "status = 'closed' WHERE paper_id = '$paper'";
        $arr = array();
        $arr[0] = $collect;
        return $obj->updation($table, $arr);
    }

    public function updateinbox($id) {
        $table = 'message_mail';
        $obj = new commonSql;

        $collect = "status = '1' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        return $obj->updation($table, $arr);
    }
    
    public function updateclassAllocator() {
        $id = $_POST['id'];
        $table = 'class_allocation';
        $obj = new commonSql;

        $collect = "active = '0' WHERE id = '$id'";
        $arr = array();
        $arr[0] = $collect;
        return $obj->updation($table, $arr);
    }

}
