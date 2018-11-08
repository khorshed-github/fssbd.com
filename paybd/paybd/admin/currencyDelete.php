<?php include 'inc/header.php';?>
<?php
if(!isset($_GET['deleteid']) || $_GET['deleteid']==NULL)
{
    header("Location:CurrencyList.php");
}
else
{
    $deleteid=$_GET['deleteid'];

    $delquery = "delete from tbCurrencyInfo where autoId = '$deleteid'";
    $deldata = $db->deletedata($delquery);

    if($deldata)
    {
        echo "<script>window.location = 'CurrencyList.php'; </script>";
        echo "<script>alert('Event Deleted Successfully !!')</script>";
    }
    else
    {
        echo "<script>alert('Event Not Deleted !!')</script>";
        echo "<script>window.location = 'CurrencyList.php'; </script>";
    }
}


?>


