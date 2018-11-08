





<?php include 'inc/header.php';?>
	
	<section id="testimonial">
   		<div class="container slide">
            <div class="row text-center">
                <h2 class="ion-minus"><span>---Testimonials---</span></h2>
            </div>
            <?php
            $query="select autoId,userId,comment,image from tbtestimonial";
            $selectData=$db->select($query);
            if($selectData)
            {
                $i=0;   $txtRight;  $commentBox;
                while($result=$selectData->fetch_assoc())
                {
                    if($i%2==0) { $txtRight="text-right";$commentBox="comment-box"; }
                    else{ $txtRight="";$commentBox="comment-box2"; }
            ?>
            <div class="row">
                <?php
                    if($i%2==0)
                    {
                ?>
                        <div class="testimonial-part">
                           <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 <?php echo $txtRight; ?>">
                             <div class="<?php echo $commentBox; ?>">
                                   <p><?php echo $result['comment'];?></p>
                             </div>
                          </div>
                          <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12  <?php echo $txtRight; ?>">
                                 <img class="img-circle" src="assets/images/female.jpg" style="width: 150px;height:150px;">
                          </div>
                        </div> 
                <?php }
                    else{
                ?>
                        <div class="testimonial-part">
                          <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12  <?php echo $txtRight; ?>">
                                 <img class="img-circle" src="assets/images/female.jpg" style="width: 150px;height:150px;">
                          </div>
                           <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12 <?php echo $txtRight; ?>">
                             <div class="<?php echo $commentBox; ?>">
                                   <p><?php echo $result['comment'];?></p>
                             </div>
                          </div>
                        </div> 
                <?php }
                ?>
             </div> 
             <?php 
				$i++;
                }
            }
			?>
             
            <!--<div class="row">
               <div class="testimonial-part">
                   <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
					 <div class="comment-box">
						   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. 
						   </p>
					 </div>
                  </div>
                  <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                         <img class="img-circle" src="assets/images/female.jpg" style="width: 150px;height:150px;">
                  </div>
                </div>  
             </div> 
             
             <div class="row">
               <div class="testimonial-part">
                   <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 text-right">
                         <img class="img-circle" src="assets/images/female.jpg" style="width: 150px;height:150px;">
                   </div>
                   <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
					 <div class="comment-box2">
						   <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. 
						   </p>
					 </div>
                  </div>
                </div>				
             </div>	-->	
              	
    </div>    
</section>



<?php include 'inc/footer.php';?>