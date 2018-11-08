<?php include 'inc/header.php';?>
<?php
    titleAndMeta('Inbox');
?>
<?php include 'inc/sidebar.php';?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                <tr>
                    <th width="10%">Serial No.</th>
                    <th width="25%">Name</th>
                    <th width="25%">Email</th>
                    <th width="30%">Subject</th>
                    <th width="10%">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $query="select autoId,name,email,subject from tbinbox";
                $selectData=$db->select($query);
                if($selectData)
                {
                    $i=0;
                    while($result=$selectData->fetch_assoc())
                    {
                        ?>
                        <tr class="odd gradeX">
                            <td> <?php echo $i;?></td>
                            <td> <?php echo $result['name']; ?> </td>
                            <td> <?php echo $result['email']; ?> </td>
                            <td> <?php echo $result['subject']; ?> </td>
                            <td>
                                <a href="inboxView.php?id=<?php echo $result['autoId'];?>">View</a> ||
                                <a onclick="return confirm('Are you sure to Delete! ');" href="inboxDelete.php?deleteid=<?php echo $result['autoId'];?>">Delete</a>
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
<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();

        setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
