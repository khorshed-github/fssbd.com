<?php
include("config/dbconnect.php");

if(!empty($_POST['fid'])){
		$num = 0;
		$select = mysqli_query($con,"SELECT * FROM facilities_details WHERE facilities_id='".$_POST['fid']."'");
		while($data = mysqli_fetch_array($select)){
			$num++;
	?>
  <tr>
	<td><?php echo $num; ?></td>
	<td><img class="img-responsive img-rounded" style="max-height:50px" src="images/facilities_details/<?php echo $data['image'];?>"></td>
	<td><?php echo $data['title'];?></td>
	<td><?php echo date("d-m-Y",strtotime($data['datetime']));?></td>
	<td>
	  <a href="edit_facilities_details.php?edt=<?php echo $data['id'];?>" class="active" ui-toggle-class=""><i class="fa fa-edit text-success text-active"></i></a>
	</td>
	<td>
	  <a href="?del=<?php echo $data['id'];?>" onclick="return confirm('Do you want to delete?')" class="active" ui-toggle-class=""><i class="fa fa-trash text-danger text"></i></a>
	</td>
  </tr>
  <?
	}
  }else{
		?>
		 <div class="alert alert-success" role="alert">
				<button type="button" class="close" data-dismiss="alert" aria-label="close">
					<span aria-hidden="true">&times;</span>
				</button>
				<span><strong>Data Not Found!!</strong></span>
		  </div>
		<?
	}
  ?> 