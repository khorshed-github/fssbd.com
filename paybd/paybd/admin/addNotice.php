
<?php include 'inc/header.php';?>
<?php
    titleAndMeta('Notice');
?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Notice Board</h2>
        <div class="block">   
<?php

	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$noticeName=mysqli_real_escape_string($db->link,$_POST['noticeName']);
		
		if(!empty($noticeName))
		{
			
			$query="update tbnoticeinfo 
			set noticeName='$noticeName'";

			$updateData=$db->update($query);
			if($updateData)
			{
				echo "<span style='color:green;font-size:18px;'>Notice Information Inserted Successfully.</span>";
			}
			else
			{
				echo "<span style='color:red;font-size:18px;'>Notice Information Not Inserted !</span>";
			}
		}
		else
	    {
			echo "<span style='color:red;font-size:18px;'>Notice Field must not be empty</span>";
	    }
	}
			
?>
        
        <?php
			$query="select noticeName from tbnoticeinfo";
			$selectData=$db->select($query);
			if($selectData)
			{
				while($result=$selectData->fetch_assoc())
				{

		?>
         <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Notice Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['noticeName']; ?>" name="noticeName" placeholder="Notice Name.." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
           </form>
           <?php 
			}
			}
		?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>