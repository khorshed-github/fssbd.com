<ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">			
                <img alt="" src="<?php echo $loggedPic;?>">
                <span class="username"><?php echo $loggedName;?></span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="profile.php"><i class=" fa fa-suitcase"></i>Profile</a></li>
                <!--<li><a href="change_password.php"><i class="fa fa-cog"></i>Change Password</a></li>-->
                <li><a href="logout.php"><i class="fa fa-key"></i> Log Out</a></li>
            </ul>
        </li>
       <!-- user login dropdown end -->      
 </ul>