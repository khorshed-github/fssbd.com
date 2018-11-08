<?php ob_start(); ?>
<?php
class Session{

    public static function init()
    {
        session_start();
    }

    public static function set($key, $val)
    {
        $_SESSION[$key] = $val;
    }

    public static function get($key)
    {
        if(isset($_SESSION[$key]))
        {
            return $_SESSION[$key];
        }
        else
        {
            return false;
        }
    }

    public static function checkSession()
    {
        self::init();
        if(self::get("adminlogin") == false)
        {
            self::destroy();
            //header("Location:login.php");
            echo "<script>window.location= 'login.php';</script>";
        }

    }

    public static function checkLogin()
    {
        self::init();
        if(self::get("adminlogin") == true)
        {
            //header("Location:index.php");
            echo "<script>window.location= 'index.php';</script>";
        }

    }

    public static function checkCusSession()
    {
        if(self::get("cusLogin") == false)
        {
            self::destroy();
            //header("Location:login.php");
            echo "<script>window.location= 'login.php';</script>";
        }
    }

    public static function checkCusLogin()
    {
        if(self::get("cusLogin") == true)
        {
            header("Location:profile.php");
            echo "<script>window.location= 'profile.php';</script>";
        }
    }

    public static function destroy()
    {
        session_destroy();
        //header("Location:login.php");
        echo "<script>window.location= 'login.php';</script>";
    }
}
?>
