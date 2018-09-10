<?php
function isLoggedIn()
{
    if(isset($_SESSION['user_id']))	
    return true;
    return false;
}


//if the user has not logged in
if(!isLoggedIn())
{
    unset($_SESSION["user_id"],$_SESSION["user_name"]);
    header('Location: index.php');
    die();
}

?>