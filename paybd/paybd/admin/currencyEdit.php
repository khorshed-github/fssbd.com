<?php include 'inc/header.php'; ?>
<?php
    titleAndMeta('Currency Edit');
?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Edit Currency</h2>
        <div class="block">

            <?php


            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $vCurrencyName = $_POST['vCurrencyName'];

                /*$vCurrencyName=mysqli_real_escape_string($db->link,$vCurrencyName);*/

                $permited = array('jpg', 'jpeg', 'png', 'gif');
                $file_name = $_FILES['image']['name'];
                $file_size = $_FILES['image']['size'];
                $file_temp = $_FILES['image']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $unique_image = substr(md5(time()), 0, 10) . '.' . $file_ext;
                $uploaded_image = "upload/" . $unique_image;


                if (!empty($vCurrencyName)) {
                    if (!empty($file_name)) {
                        if ($file_size < 1048567) {
                            if (in_array($file_ext, $permited) === true) {
                                move_uploaded_file($file_temp, $uploaded_image);
                                $query = "insert into tbcurrencyinfo (vCurrencyName,image) 
                                values(
                                '$vCurrencyName',
                                '$uploaded_image')";

                                $dataInsert = $db->insert($query);
                                if ($dataInsert) {
                                    echo "<span style='color:green;font-size:18px;'>Book Update Successfully.</span>";
                                } else {
                                    echo "<span style='color:red;font-size:18px;'>Book Not Update !</span>";
                                }
                            } else {
                                echo "<span style='color:green;font-size:18px;'>You can upload only:-" . implode(', ', $permited) . "</span>";
                            }
                        } else {
                            echo "<span style='color:green;font-size:18px;'>Image Size should be less then 1MB!</span>";
                        }
                    } else {
                        echo "<span style='color:red;font-size:18px;'>Image must not be empty</span>";
                    }

                } else {
                    echo "<span style='color:red;font-size:18px;'>Currency Name Field must not be empty</span>";
                }
            }
            ?>


            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Currency Name</label>
                        </td>
                        <td>
                            <input type="text" name="vCurrencyName" placeholder="Currency Name.." class="medium"/>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Upload Image</label>
                        </td>
                        <td>
                            <input name="image" type="file"/>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save"/>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>


