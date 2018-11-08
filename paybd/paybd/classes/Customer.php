<?php
//include '../lib/Session.php';
//Session::checkLogin();
$filepath = realpath(dirname(__FILE__));
include_once ($filepath.'/../lib/Database.php');
include_once ($filepath.'/../helpers/Format.php');
?>

<?php

class Customer{

    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function customerLogin($data)
    {
        $email 	  = $this->fm->validation($data['usernameLogin']);
        $password = $this->fm->validation(md5($data['passwordLogin']));

        $email 	  = mysqli_real_escape_string($this->db->link, $email);
        $password = mysqli_real_escape_string($this->db->link, $password);

        if(empty($email) && empty($password))
        {
            $msg = "<span class='error'>Field must not be empty !!</span>";
            return $msg;
        }

        else
        {
            $query = "select * from tbuserinfo where (username='$email' or email='$email' or mobile='$email') and password='$password'";
            $result = $this->db->select($query);

            if($result!=false)
            {
                $value = $result->fetch_assoc();
                Session::set("cusLogin",true);
                Session::set("cmrId",$value['userId']);
                Session::set("cmrName",$value['userName']);
                header("Location:profile.php");
                /*echo "<script>window.location = 'profile.php';</script>";*/
            }
            else
            {
                $msg = "<span class='error'>Email Or Password Not Matched!!</span>";
                return $msg;
            }
        }
    }


    public function customerRegister($data)
    {
        $usernameReg 	 	= $this->fm->validation($data['usernameReg']);
        $emailReg	  		= $this->fm->validation($data['emailReg']);
        $passwordReg 	  	= $this->fm->validation(md5($data['passwordReg']));
        $confirmPassReg 	= $this->fm->validation(md5($data['confirmPassReg']));

        $usernameReg 	  = mysqli_real_escape_string($this->db->link, $usernameReg);
        $emailReg 	  = mysqli_real_escape_string($this->db->link, $emailReg);
        $passwordReg 	  = mysqli_real_escape_string($this->db->link, $passwordReg);
        $confirmPassReg 	  = mysqli_real_escape_string($this->db->link, $confirmPassReg);

        if(!empty($usernameReg) && !empty($emailReg) && !empty($passwordReg) && !empty($confirmPassReg))
        {
            $userQuery="select * from tbuserinfo where userName='$usernameReg' limit 1";
            $userChk=$this->db->select($userQuery);

            if($userChk!=true)
            {
                $mailQuery="select * from tbuserinfo where email='$emailReg' limit 1";
                $mailChk=$this->db->select($mailQuery);
                if($mailChk!=true)
                {
                    if($passwordReg==$confirmPassReg)
                    {
                        $query = "insert into tbuserinfo(userName,email,password) values('$usernameReg','$emailReg','$passwordReg')";
                        $insert=$this->db->insert($query);
                        if($insert)
                        {
                            $msg = "<span class='error'>All Information Inserted Successfully !!</span>";
                            return $msg;
                        }
                        else{
                            $msg = "<span class='error'>All Information Not Inserted Successfully !!</span>";
                            return $msg;
                        }
                    }
                    else
                    {
                        $msg = "<span class='error'>Password Not Match !!</span>";
                        return $msg;
                    }
                }
                else
                {
                    $msg = "<span class='error'>Email already Exist !!</span>";
                    return $msg;
                }
            }
            else
            {
                $msg = "<span class='error'>Username already Exist !!</span>";
                return $msg;
            }
        }
        else{
            $msg = "<span class='error'>Field must not be empty !!</span>";
            return $msg;
        }
    }
}

?>