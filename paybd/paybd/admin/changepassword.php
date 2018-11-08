
<?php include 'inc/header.php';?>
<?php
    titleAndMeta('Change Password');
?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <div class="block">

            <?php


            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                $adminId     =mysqli_real_escape_string($db->link,$_POST['adminId']);
                $oldPassword     =mysqli_real_escape_string($db->link,$_POST['oldPassword']);
                $newPassword     =mysqli_real_escape_string($db->link,$_POST['newPassword']);
                $confirmPassword =mysqli_real_escape_string($db->link,$_POST['confirmPassword']);

                if(!empty($adminId))
                {
                    if(!empty($oldPassword))
                    {
                        if(!empty($newPassword))
                        {
                            if(!empty($confirmPassword))
                            {
                                if($newPassword!=$confirmPassword)
                                {
                                    //select adminId, adminUser, adminPass, adminName from tbl_admin
                                    $query="update tbl_admin set adminPass=md5('$newPassword') where adminId='$adminId'";

                                    $updateData=$db->update($query);
                                    if($updateData)
                                    {
                                        echo "<span style='color:green;font-size:18px;'>All Information Update Successfully.</span>";
                                    }
                                    else
                                    {
                                        echo "<span style='color:red;font-size:18px;'>All Information Not Update !</span>";
                                    }
                                }
                                else
                                {
                                    echo "<span style='color:red;font-size:18px;'>New Password & Confirm Password Not Match !</span>";
                                }
                            }
                            else
                            {
                                echo "<span style='color:red;font-size:18px;'>Confirm Password Field must not be empty</span>";
                            }
                        }
                        else
                        {
                            echo "<span style='color:red;font-size:18px;'>New Password Field must not be empty</span>";
                        }
                    }
                    else
                    {
                        echo "<span style='color:red;font-size:18px;'>Old Password Field must not be empty</span>";
                    }
                }
                else
                {
                    echo "<span style='color:red;font-size:18px;'>Admin Code Field must not be empty</span>";
                }
            }

            ?>

            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <label>Admin Code</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo Session::get('adminId'); ?>" name="adminId" class="medium" disabled />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Admin ID</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo Session::get('adminUser'); ?>" name="adminUser" class="medium" disabled />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Old Password</label>
                        </td>
                        <td>
                            <input type="text" name="oldPassword" placeholder="Old Password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>New Password</label>
                        </td>
                        <td>
                            <input type="text" name="newPassword" placeholder="New Password" class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Confirm Password</label>
                        </td>
                        <td>
                            <input type="text" name="confirmPassword" placeholder="Confirm Password" class="medium" />
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

        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>