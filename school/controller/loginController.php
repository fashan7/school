<?php

session_start();

class loginController {

    public function loginAction() {
        $privilege = new privilegeController;

        $username = $_POST['username'];
        $password = base64_encode($_POST['password']);

        if (!empty($username) && !empty($password)) {
            $table = "user_reg WHERE username = '$username' AND password = '$password' AND (usertype != '4' AND usertype != '5' AND usertype != '6')";
            $user = new commonSql;
            $result = $user->display($table);

            $data = array(
                "username" => $username,
                "password" => $password
            );

            if ($result['password'] == $password) {
                $userid = $result['id'];

                if ($result['usertype'] == 1) {
                    $resultPageCount = $privilege->pageCount();
                    foreach ($resultPageCount as $rowPageCount) {
                        $pagesid = $rowPageCount['id'];
                        $resultPriviledge = $privilege->countUserPrivledge($userid, $pagesid);

                        if ($resultPriviledge > 0) {
                            
                        } else {
                            $status = "yes";
                            if ($pagesid == '63' && $pagesid == '64' && $pagesid == '65') {
                                $status = "no";
                            } else {
                                $status = "yes";
                            }

                            $arr = array();
                            $arr[0] = $userid;
                            $arr[1] = $pagesid;
                            $arr[2] = 'yes';
                            $arr[3] = 'id';
                            $db = 'user_priviledge';
                            $user->insertion($db, $arr);
                        }
                    }
                }


                $arra = array();
                $arra[0] = $userid;
                $arra[1] = $privilege->getTime();
                $arra[2] = $privilege->getDate();
                $arra[3] = 'Logged In';
                $arra[4] = 'id';
                $db = 'history';
                $user->insertion($db, $arra);


                $_SESSION['loguserid'] = $userid;
                $_SESSION['username'] = $result['username'];
                $_SESSION['branch'] = $result['branch'];
                echo "done";
            } else {
                echo "undone";
            }

            return true;
        }
    }

    public function checkLoginTeacher() {
        $privilege = new privilegeController;

        $username = $_POST['username'];
        $password = base64_encode($_POST['password']);

        if (!empty($username) && !empty($password)) {
            $table = "user_reg WHERE username = '$username' AND password = '$password' AND usertype = '4'";
            $user = new commonSql;
            $result = $user->display($table);

            $data = array(
                "username" => $username,
                "password" => $password
            );

            if ($result['password'] == $password) {
                $userid = $result['id'];

                $data = array('52', '60', '62', '67');
                for ($i = 0; $i < COUNT($data); $i++) {
                    $pagesid = $data[$i];

                    $resultPriviledge = $privilege->countUserPrivledge($userid, $pagesid);

                    if ($resultPriviledge > 0) {
                        
                    } else {
                        $arr = array();
                        $arr[0] = $userid;
                        $arr[1] = $pagesid;
                        $arr[2] = 'yes';
                        $arr[3] = 'id';
                        $db = 'user_priviledge';
                        $user->insertion($db, $arr);
                    }
                }


                $arra = array();
                $arra[0] = $userid;
                $arra[1] = $privilege->getTime();
                $arra[2] = $privilege->getDate();
                $arra[3] = $username . 'Teacher Logged In';
                $arra[4] = 'id';
                $db = 'history';
                $user->insertion($db, $arra);


                $_SESSION['loguserid'] = $userid;
                $_SESSION['username'] = $result['username'];
                $_SESSION['branch'] = $result['branch'];
                echo "done";
            } else {
                echo "undone";
            }

            return true;
        }
    }

    public function checkLoginStudent() {
        $privilege = new privilegeController;

        $username = $_POST['username'];
        $password = base64_encode($_POST['password']);

        if (!empty($username) && !empty($password)) {
            $table = "user_reg WHERE username = '$username' AND password = '$password' AND usertype = '6'";
            $user = new commonSql;
            $result = $user->display($table);

            $data = array(
                "username" => $username,
                "password" => $password
            );

            if ($result['password'] == $password) {
                $userid = $result['id'];
                $data = array('52', '64', '66');
                for ($i = 0; $i < COUNT($data); $i++) {
                    $pagesid = $data[$i];

                    $resultPriviledge = $privilege->countUserPrivledge($userid, $pagesid);

                    if ($resultPriviledge > 0) {
                        
                    } else {
                        $arr = array();
                        $arr[0] = $userid;
                        $arr[1] = $pagesid;
                        $arr[2] = 'yes';
                        $arr[3] = 'id';
                        $db = 'user_priviledge';
                        $user->insertion($db, $arr);
                    }
                }


                $arra = array();
                $arra[0] = $userid;
                $arra[1] = $privilege->getTime();
                $arra[2] = $privilege->getDate();
                $arra[3] = $username . 'Student Logged In';
                $arra[4] = 'id';
                $db = 'history';
                $user->insertion($db, $arra);


                $_SESSION['loguserid'] = $userid;
                $_SESSION['username'] = $result['username'];
                $_SESSION['branch'] = $result['branch'];
                echo "done";
            } else {
                echo "undone";
            }

            return true;
        }
    }

    public function checkLoginParents() {
        $privilege = new privilegeController;

        $username = $_POST['username'];
        $password = base64_encode($_POST['password']);

        if (!empty($username) && !empty($password)) {
            $table = "user_reg WHERE username = '$username' AND password = '$password' AND usertype = '5'";
            $user = new commonSql;
            $result = $user->display($table);

            $data = array(
                "username" => $username,
                "password" => $password
            );

            if ($result['password'] == $password) {
                $userid = $result['id'];

                $data = array('52', '63', '65', '68');
                for ($i = 0; $i < COUNT($data); $i++) {
                    $pagesid = $data[$i];

                    $resultPriviledge = $privilege->countUserPrivledge($userid, $pagesid);

                    if ($resultPriviledge > 0) {
                        
                    } else {
                        $arr = array();
                        $arr[0] = $userid;
                        $arr[1] = $pagesid;
                        $arr[2] = 'yes';
                        $arr[3] = 'id';
                        $db = 'user_priviledge';
                        $user->insertion($db, $arr);
                    }
                }


                $arra = array();
                $arra[0] = $userid;
                $arra[1] = $privilege->getTime();
                $arra[2] = $privilege->getDate();
                $arra[3] = $username . 'Parent Logged In';
                $arra[4] = 'id';
                $db = 'history';
                $user->insertion($db, $arra);


                $_SESSION['loguserid'] = $userid;
                $_SESSION['username'] = $result['username'];
                $_SESSION['branch'] = $result['branch'];
                echo "done";
            } else {
                echo "undone";
            }

            return true;
        }
    }

    public function logoutAction() {
        unset($_SESSION['loguserid']);
        unset($_SESSION['username']);
        unset($_SESSION['branch']);

        if (session_destroy())
            echo "signout";
    }

}
