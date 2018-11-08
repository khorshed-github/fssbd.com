<?php include 'inc/header.php';?>
<?php
    titleAndMeta('Currency List');
?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Book List</h2>
        <div class="block">
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
                $query="select autoId, vCurrencyName, image from tbCurrencyInfo";
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
                            <td> <img src="<?php echo $result['image']; ?>" alt="image" height="60px" width="40px"> </td>
                            <td><a href="currencyEdit.php?id=<?php echo $result['autoId'];?>">Edit</a> || <a onclick="return confirm('Are you sure to Delete! ');" href="currencyDelete.php?deleteid=<?php echo $result['autoId'];?>">Delete</a></td>
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
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();

        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
