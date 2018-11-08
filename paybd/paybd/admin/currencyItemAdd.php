<?php include 'inc/header.php';?>
<?php
    titleAndMeta('Currency Item Add');
?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add Currency Item</h2>
        <div class="block">

            <?php


            if($_SERVER['REQUEST_METHOD']=='POST' && isset($_POST['submit']))
            {
                $vType = mysqli_real_escape_string($db->link,$_POST['vType']);
                $iCurrencyIdFrom = mysqli_real_escape_string($db->link,$_POST['iCurrencyIdFrom']);
                $dblAmountFrom = mysqli_real_escape_string($db->link,$_POST['dblAmountFrom']);
                $iCurrencyIdTo = mysqli_real_escape_string($db->link,$_POST['iCurrencyIdTo']);
                $dblAmountTo = mysqli_real_escape_string($db->link,$_POST['dblAmountTo']);
                $dblCharge = mysqli_real_escape_string($db->link,$_POST['dblCharge']);

                if($vType!='0')
                {
                    if($iCurrencyIdFrom!='0')
                    {
                        if($dblAmountFrom!='0')
                        {
                            if($iCurrencyIdTo!='0')
                            {
                                if($dblAmountTo!='0')
                                {
                                    $query="select vType from tbcurrencyiteminfo where vType='$vType' and iCurrencyIdFrom='$iCurrencyIdFrom' and iCurrencyIdTo='$iCurrencyIdTo' ";
                                    $selectData=$db->select($query);
                                    if($selectData!=true)
                                    {
                                        $query="insert into tbcurrencyiteminfo (vType, iCurrencyIdFrom, dblAmountFrom, iCurrencyIdTo, dblAmountTo, dblCharge) 
                                        values('$vType','$iCurrencyIdFrom','$dblAmountFrom','$iCurrencyIdTo','$dblAmountTo','$dblCharge')";

                                        $dataInsert=$db->insert($query);
                                        if($dataInsert)
                                        {
                                            echo "<span style='color:green;font-size:18px;'>Currency Item Insertion Successful.</span>";
                                        }
                                        else
                                        {
                                            echo "<span style='color:red;font-size:18px;'>Currency Item Insertion Failed!</span>";
                                        }
                                    }
                                    else
                                    {
                                        echo "<span style='color:red;font-size:18px;'>Currency Item Already Exist.</span>";
                                    }
                                }
                                else
                                {
                                    echo "<span style='color:red;font-size:18px;'>Currency To Amount Field must not be Zero.</span>";
                                }
                            }
                            else
                            {
                                echo "<span style='color:red;font-size:18px;'>Currency To must not be empty.</span>";
                            }
                        }
                        else
                        {
                            echo "<span style='color:red;font-size:18px;'>Currency From Amount Field must not be Zero.</span>";
                        }
                    }
                    else
                    {
                        echo "<span style='color:red;font-size:18px;'>Currency From must not be empty.</span>";
                    }
                }
                else
                {
                    echo "<span style='color:red;font-size:18px;'>Type must not be empty.</span>";
                }
            }
            ?>

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                    <!--Item type-->
                    <tr>
                        <td>
                            <label>Type</label>
                        </td>
                        <td>
                            <select id="select" name="vType">
                                <option value="0">Select Type</option>
                                <option value="Buy">Buy</option>
                                <option value="Sell">Sell</option>
                            </select>
                        </td>
                    </tr>
                    <!--Item type-->
                    <!--Currency Name from-->
                    <tr>
                        <td>
                            <label>Currency Name</label>
                        </td>
                        <td>
                            <select id="select" name="iCurrencyIdFrom">
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
                    <!--Currency Name from-->

                    <tr>
                        <td>
                            <label>Amount</label>
                        </td>
                        <td>
                            <input type="number" name="dblAmountFrom" value="0" placeholder="Enter Amount..."  />
                        </td>
                    </tr>

                    <!--Currency Name from-->
                    <tr>
                        <td>
                            <label>Currency Name</label>
                        </td>
                        <td>
                            <select id="select" name="iCurrencyIdTo">
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
                    <!--Currency Name from-->

                    <tr>
                        <td>
                            <label>Amount</label>
                        </td>
                        <td>
                            <input type="number" name="dblAmountTo" value="0" placeholder="Enter Amount..."  />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Charge</label>
                        </td>
                        <td>
                            <input type="number" name="dblCharge" value="0" placeholder="Enter Amount..."  />
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

            <hr>


            <!--Table Data Load End-->

            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Type</th>
                    <th>Currency From</th>
                    <th>Amount From</th>
                    <th>Currency To</th>
                    <th>Amount To</th>
                    <th>Charge</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query="select autoId,vType,(select vCurrencyName from tbcurrencyinfo where autoId=a.iCurrencyIdFrom) vCurrencyNameFrom, dblAmountFrom, 
                        (select vCurrencyName from tbcurrencyinfo where autoId=a.iCurrencyIdTo) vCurrencyNameTo, dblAmountTo, dblCharge from tbcurrencyiteminfo a";
                $selectData=$db->select($query);
                if($selectData)
                {
                    $i=0;
                    while($result=$selectData->fetch_assoc())
                    {
                        ?>
                        <tr class="odd gradeX">
                            <td> <?php echo $i;?></td>
                            <td> <?php echo $result['vType'];?></td>
                            <td> <?php echo $result['vCurrencyNameFrom']; ?> </td>
                            <td> <?php echo $result['dblAmountFrom']; ?> </td>
                            <td> <?php echo $result['vCurrencyNameTo']; ?> </td>
                            <td> <?php echo $result['dblAmountTo']; ?> </td>
                            <td> <?php echo $result['dblCharge']; ?> </td>
                            <td><a href="currencyItemEdit.php?id=<?php echo $result['autoId'];?>">Edit</a> ||
                                <a onclick="return confirm('Are you sure to Delete! ');" href="currencyItemDelete.php?deleteid=<?php echo $result['autoId'];?>">Delete</a>
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


