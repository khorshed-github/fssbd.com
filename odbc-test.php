<?php

/* $server = '192.168.75.2';
    $user = 'sa';
    $pass = '123';
    //Define Port
    $port='Port=1433';
    $database = 'TeaResort';

    $connection_string = "DRIVER={SQL Server};SERVER=$server;$port;DATABASE=$database";
    $conn = odbc_connect($connection_string,$user,$pass);
    if ($conn) {
        echo "Connection established.";
    } else{
        die("Connection could not be established.");
    }
	
exit; */

$conn = odbc_connect("Driver={SQL Server Native Client 10.0};Server=server_name,1433;Database=database_name;", 'user', 'password');

 if (!$conn)
  {exit("Connection Failed: " . $conn);}

$sql="SELECT top 10 * FROM tbBookingSetup";
$rs=odbc_exec($conn,$sql);
if (!$rs)
  {exit("Error in SQL");}
echo "<table><tr>";
echo "<th>TypeName</th>";
echo "<th>roomRate</th></tr>";
while (odbc_fetch_row($rs))
{
  $compname=odbc_result($rs,"typeName");
  $conname=odbc_result($rs,"roomRate");
  echo "<tr><td>$compname</td>";
  echo "<td>$conname</td></tr>";
}
odbc_close($conn);
echo "</table>"; 
?>