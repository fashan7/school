<?php
class loginController
{
    public function loginAction()
    {        
        $username = $_POST['username'];
        $password = base64_encode($_POST['password']);
        $studentusername = substr($username, 0, 6);
        if(!empty($username) && !empty($password))
        {
            $table  = "user_reg WHERE username = '$username' AND password = '$password' AND (usertype = '1' OR usertype = '3')";
            $user   = new commonSql;
            $result = $user->display($table);
            $data = array(
                "username"     => $username,
                "password"  => $password
            ); 
            if($result['password'] == $password)
            {
                $userid  = $result['id']; 
                $_SESSION['logusersid'] = $userid;
                $_SESSION['logbrchid'] = $result['branch'];
                $_SESSION['usrname']  = $result['username'];
                setcookie("username", $result['username'], time() + 3600);
                echo "done";
            }
            else
            {
                echo "undone";
            }                           
            return true;
        }      
    }
    
    public function logoutAction()
    {
        unset($_SESSION['logusersid']);
        unset($_SESSION['usrname']);
        unset($_SESSION['logbrchid']);

        if(session_destroy())
        {
            header('Location: login');
        }
    }
}