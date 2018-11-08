<?php include 'inc/header.php';?>
<?php
titleAndMeta('Currency Transaction');
?>
<?php include 'inc/sidebar.php';?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Currency Transaction</h2>
        <div class="block">

            <!--Table Data Load End-->

            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th>SL#</th>
                    <th>Type</th>
                    <th>User Name</th>
                    <th>Date</th>
                    <th>From</th>
                    <th>Amount</th>
                    <th>To</th>
                    <th>Amount</th>
                    <th>Charge</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query="select autoId,vType,(select vCurrencyName from tbcurrencyinfo where autoId=a.iCurrencyIdFrom) vCurrencyNameFrom, dblAmountFrom, 
                        (select vCurrencyName from tbcurrencyinfo where autoId=a.iCurrencyIdTo) vCurrencyNameTo, dblAmountTo, dblCharge from tbcurrencyiteminfo a 
                        order by autoId desc";
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
                            <td> <?php echo "Emdidar"; ?> </td>
                            <td> <?php echo "31-10-2018"; ?> </td>
                            <td> <?php echo $result['vCurrencyNameFrom']; ?> </td>
                            <td> <?php echo $result['dblAmountFrom']; ?> </td>
                            <td> <?php echo $result['vCurrencyNameTo']; ?> </td>
                            <td> <?php echo $result['dblAmountTo']; ?> </td>
                            <td> <?php echo $result['dblCharge']; ?> </td>
                            <td> <?php echo "Processed"; ?> </td>
                            <td><a href="currencyItemEdit.php?id=<?php echo $result['autoId'];?>">Edit</a></td>
                        </tr>
                        <?php
                        $i++;
                    }
                    /*Processed
                    Awaiting Confirmation
                    Awaiting Payment
                    Canceled*/
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


