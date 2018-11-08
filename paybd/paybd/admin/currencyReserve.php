<?php include 'inc/header.php';?>
<?php
titleAndMeta('Add Reserve Currency');
?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Reserve Currency</h2>
        <div class="block">

            <?php


            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
            {
                $iCurrencyId = mysqli_real_escape_string($db->link,$_POST['iCurrencyId']);
                $dblAmount = mysqli_real_escape_string($db->link,$_POST['dblAmount']);

                
                if($iCurrencyId!='0')
                {
                    $query="select iCurrencyId from tbcurrencyreserve where iCurrencyId='$iCurrencyId' ";
                    $selectData=$db->select($query);
                    if($selectData!=true)
                    {
                        $query="insert into tbcurrencyreserve (iCurrencyId, dblAmount) 
                                    values('$iCurrencyId','$dblAmount')";

                        $dataInsert=$db->insert($query);
                        if($dataInsert)
                        {
                            echo "<span style='color:green;font-size:18px;'>Currency Insertion Successful.</span>";
                        }
                        else
                        {
                            echo "<span style='color:red;font-size:18px;'>Currency Insertion Failed!</span>";
                        }
                    }
                    else
                    {
                        echo "<span style='color:red;font-size:18px;'>Currency Already Exist.</span>";
                    }
                }
                else
                {
                    echo "<span style='color:red;font-size:18px;'>Currency must not be empty.</span>";
                }
                
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <!--Currency Name Start-->
                    <tr>
                        <td>
                            <label>Currency Name</label>
                        </td>
                        <td>
                            <select id="select" name="iCurrencyId">
                                <option value="0">Select Currency</option>
                                <?php
                                $query="select autoId, vCurrencyName, image from tbcurrencyinfo";
                                $selectData=$db->select($query);
                                if($selectData)
                                {
                                    while($result=$selectData->fetch_assoc())
                                    {

                                        ?>
                                        <option value="<?php echo $result['autoId']; ?>"><?php echo $result['vCurrencyName']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <!--Currency Name End-->

                    <!--Currency Amount Start-->
                    <tr>
                        <td>
                            <label>Amount</label>
                        </td>
                        <td>
                            <input type="number" name="dblAmount" value="0" placeholder="Enter Amount..."  />
                        </td>
                    </tr>
                    <!--Currency Amount End-->
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>

            <hr>


            <!--Table Data Load End-->

            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Currency Name</th>
                    <th>Amount</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query="select autoId,(select vCurrencyName from tbcurrencyinfo where autoId=a.iCurrencyId) vCurrencyName, dblAmount 
                        from tbcurrencyreserve a";
                $selectData=$db->select($query);
                if($selectData)
                {
                    $i=0;
                    while($result=$selectData->fetch_assoc())
                    {
                        ?>
                        <tr class="odd gradeX">
                            <td> <?php echo $i;?></td>
                            <td> <?php echo $result['vCurrencyName']; ?> </td>
                            <td> <?php echo $result['dblAmount']; ?> </td>
                            <td><a href="currencyReserveEdit.php?id=<?php echo $result['autoId'];?>">Edit</a> ||
                                <a onclick="return confirm('Are you sure to Delete! ');" href="currencyReserveDelete.php?deleteid=<?php echo $result['autoId'];?>">Delete</a>
                            </td>
                        </tr>
                        <?php
                        $i++;
                    }
                }
                ?>
                </tbody>
            </table>

            <!--Table Data Load End-->


        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();

        setSidebarHeight();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


