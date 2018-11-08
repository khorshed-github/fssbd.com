
<?php include 'inc/header.php';?>
<?php
    titleAndMeta('Social Info');
?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Social Info</h2>
        <div class="block">   
<?php

	
	if($_SERVER['REQUEST_METHOD']=='POST')
	{
		$youtube=mysqli_real_escape_string($db->link,$_POST['youtube']);
		$facebook=mysqli_real_escape_string($db->link,$_POST['facebook']);
		$twiter=mysqli_real_escape_string($db->link,$_POST['twiter']);
		$instagram=mysqli_real_escape_string($db->link,$_POST['instagram']);
		
		if(!empty($youtube))
		{
			if(!empty($facebook))
			{
				if(!empty($twiter))
				{
					if(!empty($instagram))
					{
						$query="update tbsocialinfo 
						set youtube='$youtube',
						facebook='$facebook',
						twiter='$twiter',
						instagram='$instagram'";
						
						$updateData=$db->update($query);
						if($updateData)
						{
							echo "<span style='color:green;font-size:18px;'>Social Information Inserted Successfully.</span>";
						}
						else
						{
							echo "<span style='color:red;font-size:18px;'>Social Information Not Inserted !</span>";
						}
					}
					else
					{
						echo "<span style='color:red;font-size:18px;'>Instagram Field must not be empty</span>";
					}
				}
				else
				{
					echo "<span style='color:red;font-size:18px;'>Twiter Field must not be empty</span>";
				}
			}
			else
			{
				echo "<span style='color:red;font-size:18px;'>Facebook Field must not be empty</span>";
			}
		}
		else
	    {
			echo "<span style='color:red;font-size:18px;'>Youtube Field must not be empty</span>";
	    }
	}
			
?>
        
        <?php
			$query="select youtube,facebook,twiter,instagram from tbsocialinfo";
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
                        <label>YouTube</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['youtube']; ?>" name="youtube" placeholder="Youtube  Link.." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['facebook']; ?>" name="facebook" placeholder="Facebook Link.." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Twiter</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['twiter']; ?>" name="twiter" placeholder="Twiter Link..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Instagram</label>
                    </td>
                    <td>
                        <input type="text" value="<?php echo $result['instagram']; ?>" name="instagram" placeholder="Instagram Link..." class="medium" />
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