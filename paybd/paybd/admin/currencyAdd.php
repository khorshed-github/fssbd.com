<?php include 'inc/header.php'; ?>
<?php
    titleAndMeta('Currency Add');
?>
<?php include 'inc/sidebar.php'; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Currency</h2>
        <div class="block">

            <?php

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {

                $vCurrencyName=mysqli_real_escape_string($db->link,$_POST['vCurrencyName']);
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
                                    echo "<span style='color:green;font-size:18px;'>Currency Inserted Successfully.</span>";
                                } else {
                                    echo "<span style='color:red;font-size:18px;'>Currency Not Inserted !</span>";
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

            <hr>

            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th width="10%">Serial No.</th>
                    <th width="35%">Currency Name</th>
                    <th width="35%">Image</th>
                    <th width="20%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query = "select autoId, vCurrencyName, image from tbcurrencyinfo";
                $selectData = $db->select($query);
                if ($selectData) {
                    $i = 0;
                    while ($result = $selectData->fetch_assoc()) {
                        ?>
                        <tr class="odd gradeX">
                            <td> <?php echo $i; ?></td>
                            <td> <?php echo $result['vCurrencyName']; ?> </td>
                            <td><img src="<?php echo $result['image']; ?>" alt="image" height="60px" width="40px">
                            </td>
                            <td><a href="currencyEdit.php?id=<?php echo $result['autoId']; ?>">Edit</a> || <a
                                        onclick="return confirm('Are you sure to Delete! ');"
                                        href="currencyDelete.php?deleteid=<?php echo $result['autoId']; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
                </tbody>
            </table>



        </div>
    </div>
</div>
<?php include 'inc/footer.php'; ?>


<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();

        setSidebarHeight();
    });
</script>
<!-- Load TinyMCE -->