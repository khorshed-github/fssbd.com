<?php include '../lib/Session.php'; ?>
<?php
Session::checkLogin();

include_once '../lib/Database.php';
include_once '../helpers/Format.php';

class Adminlogin
{
    private $db;
    private  $fm;
    public function __construct()
    {
        $this->db=new Database();
        $this->fm=new Format();
    }
    public function adminLogin($adminUser,$adminPass)
    {
        $adminUser=mysqli_real_escape_string($this->db->link,$this->fm->validation($adminUser));
        $adminPass=mysqli_real_escape_string($this->db->link,$this->fm->validation($adminPass));

        if (empty($adminUser)||empty($adminPass))
        {
            $loginmsg="Username or Password must not be empty !";
            return $loginmsg;
        }
        else{
            $query="select * from tbl_admin where adminUser='$adminUser' and adminPass='$adminPass'";
            $result=$this->db->select($query);
            if ($result!=false)
            {
                $value = $result->fetch_assoc();
                Session::set("adminlogin",true);
                Session::set("adminId",$value['adminId']);
                Session::set("adminUser",$value['adminUser']);
                Session::set("adminName",$value['adminName']);
                //header("Location:login.php");
                echo "<script>window.location= 'login.php';</script>";
            }
            else{
                $loginmsg="Username or Password not match !";
                return $loginmsg;
            }

        }
    }
}

?>