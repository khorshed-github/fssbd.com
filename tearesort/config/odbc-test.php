<html>
<body>
<?php
$conn = odbc_connect("Driver={SQL Server Native Client 10.0};Server=10.0.0.2;Database=TeaResort;", 'sa', '123');
/* if (!$conn)
  {exit("Connection Failed: " . $conn);} */
/* $sql="SELECT * FROM tbBookingSetup";
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
echo "</table>"; */
?>
</body>
</html>