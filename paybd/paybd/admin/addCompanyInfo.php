
<?php include 'inc/header.php';?>
<?php
    titleAndMeta('Company Info');
?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Company Info</h2>
        <div class="block">   
<?php

	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$companyName=mysqli_real_escape_string($db->link,$_POST['companyName']);
		$email=mysqli_real_escape_string($db->link,$_POST['email']);
		$mobile=mysqli_real_escape_string($db->link,$_POST['mobile']);
		$officeAddress=mysqli_real_escape_string($db->link,$_POST['officeAddress']);
		
		
		/*$eventDescription=$_POST['eventDescription'];
		$eventDescription=mysqli_real_escape_string($db->link,$eventDescription);*/
		if(!empty($companyName))
		{
			if(!empty($email))
			{
				if(!empty($mobile))
				{
					if(!empty($officeAddress))
					{
						$query="update tbcompanyinfo 
						set companyName='$companyName',
						email='$email',
						mobile='$mobile',
						officeAddress='$officeAddress'";
						
						$updateData=$db->update($query);
						if($updateData)
						{
							echo "<span style='color:green;font-size:18px;'>Company Information Inserted Successfully.</span>";
						}
						else
						{
							echo "<span style='color:red;font-size:18px;'>Company Information Not Inserted !</span>";
						}
					}
					else
					{
						echo "<span style='color:red;font-size:18px;'>Office Address Field must not be empty</span>";
					}
				}
				else
				{
					echo "<span style='color:red;font-size:18px;'>Mobile Field must not be empty</span>";
				}
			}
			else
			{
				echo "<span style='color:red;font-size:18px;'>Email Field must not be empty</span>";
			}
		}
		else
	    {
			echo "<span style='color:red;font-size:18px;'>Company Name Field must not be empty</span>";
	    }
	}
			
?>
        
        <?php
			$query="select companyName,email,mobile,officeAddress from tbcompanyinfo";
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
                        <label>Company Name</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['companyName']; ?>" name="companyName" placeholder="Company Name.." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Email</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['email']; ?>" name="email" placeholder="Email.." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Mobile</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['mobile']; ?>" name="mobile" placeholder="Mobile No..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Address</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['officeAddress']; ?>" name="officeAddress" placeholder="Office Address..." class="medium" />
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