<?php
    $myServer = "server name";
    $myUser = "sa";
    $myPass = "pass";
    $myDB = "db name";
    
    $conn = mssql_connect($myServer,$myUser,$myPass);
    if (!$conn)
    { 
      die('Not connected : ' . mssql_get_last_message());
    } 
    $db_selected = mssql_select_db($myDB, $conn);
    if (!$db_selected) 
    {
          
      die ('Can\'t use db : ' . mssql_get_last_message());
    } 
    if ($db_selected)
    { 
        echo 'Got it!!!';
    } 
    
     // SELECT DATA
    
    $tsql = "SELECT * FROM tbLoginDetails";  
    $stmt = mssql_query($tsql);  
    
    if ($stmt)  
    {  
         echo "Statement executed.<br>\n";  
    }   
    else   
    {  
         echo "Error in statement execution.\n";  
         die( print_r( mssql_errors(), true));  
    }  
    
    /* Iterate through the result set printing a row of data upon each iteration.*/  
?>
        <table border="1">
			<thead>
				<tr>
					<th>UID</th>
					<th>ModuleID</th>
					<th>ModuleName</th>
				</tr>
			</thead>
			<tbody>
			<?php
                while( $row = mssql_fetch_array( $stmt))  
                {  
            ?>
				<tr>
					<td><?php echo $row[0]; ?></td>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[2]; ?></td>
				</tr>
				<?php
				}
				?>
				
			</tbody>
		</table>
