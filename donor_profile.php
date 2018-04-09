<?php
$no1=0;
$no2=0;
$no=0;
$no3=0;
$no4=0;
session_start();
include_once 'user-dbop.php';
    $objUser = new User();
	$result=$objUser->display();
	$no=mysqli_num_rows( $result );
    $user_resource = $objUser->logd($_SESSION['reg_no']);
	//$activity_array['progress']=$objUser->report($_SESSION['reg_no'],1);
	//$activity_array['closed']=$objUser->report($_SESSION['reg_no'],2);
	//$activity_array['withdrawn']=$objUser->report($_SESSION['reg_no'],3);
	//$activity_array['waiting']=$objUser->report($_SESSION['reg_no'],4);
    $act=$objUser->activity_log($_SESSION['reg_no']);
	$his=$objUser->history($_SESSION['reg_no']);
	$notif=$objUser->notify($_SESSION['reg_no']);
	$ser_type=$objUser->select_ser();
	$loc=$objUser->select_loc();
	$type=$objUser->select_type();
	$name=$objUser->select_name();
	$no1=mysqli_num_rows( $act );
	$no2=mysqli_num_rows( $his );
	$no3=mysqli_num_rows( $notif );
    $no4=mysqli_num_rows( $ser_type);

//if (!isset($_SESSION))
  //  session_start();
if (empty($_SESSION['email_id'])) {
    header("location:index.php");
    exit();
} 
//else {
    

   if(isset($_POST['value']))
   {
	   $result=$objUser->searchl($_POST['value'],$_POST['parameter']);
	   
	  
	  
	    $no=mysqli_num_rows( $result );
	   
   }
   
   
   
	
	 /*if(session_destroy()) // Destroying All Sessions
     {
        header("Location: index.php"); // Redirecting To Home Page
      } */

//}



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    
    <title>Complete User Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style type="text/css">
    	body{margin-top:20px;} 

        .checked {
    color: orange;
}		
    </style>
</head>
<body>
<hr>
<div class="container bootstrap snippet">
    <div class="row">
        <div class="col-sm-10">
            <h1><?php echo $user_resource['org_name'] ?></h1>
			<h5><?php echo $user_resource['caption'] ?></h5>
			
			</div>
        <div class="col-sm-2">
            <a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->

            <ul class="list-group">
                <li class="list-group-item text-muted">Profile</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Email Id</strong></span> <?php echo $user_resource['email_id'] ?></li>
				<li class="list-group-item text-right"><span class="pull-left"><strong>Contact</strong></span> <?php echo $user_resource['cont'] ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Rating</strong></span> 
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star checked"></span>
<span class="fa fa-star"></span>
<span class="fa fa-star"></span> </li>
                

            </ul>

            <div class="panel panel-default">
                <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
                <div class="panel-body"><a href="http://<?php echo $user_resource['website'] ?>"><?php echo $user_resource['website'] ?></a></div>
            </div>

          <!--  <ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>IN PROGRESS</strong></span> </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>CLOSED</strong></span> </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>WITHDRAWN</strong></span> </li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>WAITING </strong></span> </li>
            </ul>  -->
			
		<!--	<ul class="list-group">
                <li class="list-group-item text-muted">Activity <i class="fa fa-dashboard fa-1x"></i></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Shares</strong></span> 125</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Likes</strong></span> 13</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Posts</strong></span> 37</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Followers</strong></span> 78</li>
            </ul> -->

            

        </div>
        <!--/col-3-->
        <div class="col-sm-9">

            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#search" data-toggle="tab">Requests</a></li>
                <li><a href="#activity" data-toggle="tab">Activity Log</a></li>
				<li><a href="#notification" data-toggle="tab">Notification</a></li>
				<li><a href="#history" data-toggle="tab">History</a></li>
                <li><a href="#settings" data-toggle="tab">Profile</a></li>
				<li><a href="logout.php" >Logout</a></li>
            </ul>

            <div class="tab-content">
			
			    <div class="tab-pane active" id="search">
				<br/>
				
				<h4>Available Values <br/></h4>
						Service Type &nbsp; &nbsp; &nbsp;
						<?php echo "<select id='ser_type' name='ser_type'> ";
              while ($row=   mysqli_fetch_assoc($ser_type) )
                   {
              echo "<option value={$row['id']} >".htmlspecialchars($row['type'])."</option>";
               }
                echo "</select>";   ?> 
			&nbsp; &nbsp; &nbsp;	Location &nbsp; &nbsp; 
				<?php echo "<select id='loc' name='ser_type'> ";
              while ($row=   mysqli_fetch_assoc($loc) )
                   {
              echo "<option value={$row['location']} >".htmlspecialchars($row['location'])."</option>";
               }
                echo "</select>";   ?> 
				
				
				&nbsp; &nbsp; &nbsp;	Organization &nbsp; &nbsp; 
				<?php echo "<select id='loc' name='ser_type'> ";
              while ($row=   mysqli_fetch_assoc($type) )
                   {
              echo "<option value={$row['type']} >".htmlspecialchars($row['type'])."</option>";
               }
                echo "</select>";   ?> <br/> <br/>


              &nbsp; &nbsp; &nbsp;	Seekers &nbsp; &nbsp; 
				<?php echo "<select id='loc' name='ser_type'> ";
              while ($row=   mysqli_fetch_assoc($name) )
                   {
              echo "<option value={$row['org_name']} >".htmlspecialchars($row['org_name'])."</option>";
               }
                echo "</select>";   ?> 				
				
				
				<br/> <br/>
				<form action="donor_profile.php" method="post">
                 
				  
		            		  <select name="parameter" id="parameter">
                              <option value="1">Location</option>
                              <option value="2">Type of Organization</option>
                             <option value="3">Service Type</option>
                              <option value="4">Seeker Name</option>
                              </select>
						Value: <input type="text" name="value" id="value">
						<input type="submit" value="Search">
						</form> <br/> <br/>
						
                
				 
				
                
				 
			
				  <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                               
                                <th>Seeker Name</th>
								<th>Summary</th>
                                <th>Type</th>
								<th>Location</th>
	                            <th>Service Required</th>
	                             <th>Date</th>
								 <th>Details</th>
	   
	  
                                  </tr>
                            </thead>
                            <tbody id="items">
                                <?php
                              if( $no==0 ){
                                 echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                                 }else{
                                while( $row = mysqli_fetch_assoc( $result ) ){
									$req_id=$row['id'];
                               echo " <tr ><td>{$row['org_name']}</td><td>{$row['brief']}</td><td>{$row['type']}</td><td>{$row['location']}</td><td>{$row['ser_type']}</td> <td>{$row['date_req']}</td><td><a href='detailed.php?id=$req_id'>More</a></td></tr>\n";
                                }
                                  }
                                      ?>
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <ul class="pagination" id="myPager"></ul>
                            </div>
                        </div>
                    </div>
                    <!--/table-resp-->

                    <hr>
				      
				
				</div>
				
				
				
				
				
				
                <div class="tab-pane " id="activity">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                               <tr>
	                          <th>Transaction Id</th>
                               <th>Request Id</th>
                               <th>Seeker Name</th>
	                           <th>Location</th>
                               <th>Type</th>
	                            <th>Service Required</th>
	                            <th>Date</th>
	                           <th>Status</th>
	                            </tr>
                            </thead>
                            <tbody id="items">
                               <?php
                                 if( $no1==0 ){
                                      echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                                       }else{
                                      while( $row = mysqli_fetch_assoc( $act ) ){
                                       echo " <tr><td>{$row['trans_id']}</td></a><td>{$row['req_id']}</td><td>{$row['org_name']}</td><td>{$row['location']}</td> <td>{$row['type']}</td> <td>{$row['ser_type']}</td> <td>{$row['open_date']}</td> <td>{$row['status']}</td></tr>\n";
                                             }
                                           }
                                        ?>  
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <ul class="pagination" id="myPager"></ul>
                            </div>
                        </div>
                    </div>
                    <!--/table-resp-->

                    <hr>

                </div>
				
				
				
				
                <div class="tab-pane" id="history">

                    <h2></h2>
					
					 <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                               <tr>
                           <th>Transaction Id</th>
                           <th>Request Id</th>
                           <th>Seeker Name</th>
	                       <th>Location</th>
                           <th>Type</th>
	                        <th>Service Required</th>
	                        <th>Date</th>
	                         <th>Status</th>
                              </tr>
                            </thead>
                            <tbody id="items">
                               <?php
                              if( $no2==0 ){
                                     echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                                  }else{
                                 while( $row = mysqli_fetch_assoc( $his ) ){
                                  echo " <tr><td data-title='Transaction ID'>{$row['trans_id']}</td></a><td data-title='Request Id'>{$row['req_id']}</td data-title='Seeker Name'><td>{$row['org_name']}</td><td data-title='Location'>{$row['location']}</td> <td data-title='Type'>{$row['type']}</td> <td data-title='Service Required'>{$row['ser_type']}</td> <td data-title='Date'>{$row['open_date']}</td> <td data-title='Status'>{$row['status']}</td></tr>\n";
                                    }
                                     }
                                      ?> 
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <ul class="pagination" id="myPager"></ul>
                            </div>
                        </div>
                    </div>

                    

                </div>
                <!--/tab-pane-->
				<div class="tab-pane" id="notification">
			     
				 <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                               <tr>
                           <th>Vendor</th>
                           <th>Request Brief</th>
                           
	                         <th>Details</th>
                              </tr>
                            </thead>
                            <tbody id="items">
                               <?php
                              if( $no3==0 ){
                                     echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                                  }else{
                                 while( $row = mysqli_fetch_assoc( $notif ) ){
									 $req_id=$row['id'];
									 $vtrans_id=$row['vtrans_id'];
									 $trans_id=$row['trans_id'];
									 $_SESSION['dno']=$row['reg_no'];
									 
                                  echo " <tr><td>{$row['org_name']}</td><td >{$row['brief']}</td> <td><a href='details_vr.php?req_id=$req_id&vtrans_id=$vtrans_id&trans_id=$trans_id'>More</a></td> </tr>\n";
                                    }
                                     }
                                      ?> 
                            </tbody>
                        </table>
                        <hr>
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 text-center">
                                <ul class="pagination" id="myPager"></ul>
                            </div>
                        </div>
                    </div>
			
			
			
				
				</div>
				
				
                <div class="tab-pane" id="settings">

                    <hr>
                    <form class="form" action="profile_update.php" method="post" id="registrationForm">
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="first_name">
                                    <h4>Organization Name</h4></label>
                                <input type="text" class="form-control" name="org_name" id="org_name" value="<?php echo $user_resource['org_name'] ?>"    >
                            </div>
                        </div>
                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="last_name">
                                    <h4>Mobile Number</h4></label>
                                <input type="text" class="form-control" name="cont" id="cont" value="<?php echo $user_resource['cont'] ?>"  >
                            </div>
                        </div>

                        <div class="form-group">

                            <div class="col-xs-6">
                                <label for="phone">
                                    <h4>GST Number</h4></label>
                                <input type="text" class="form-control" name="gst" id="gst" value="<?php echo $user_resource['gst'] ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile">
                                    <h4>Type</h4></label>
                                <input type="text" class="form-control" name="type" id="type" value="<?php echo $user_resource['type'] ?>" >
                            </div>
                        </div>
						
						
						<div class="form-group">

                            <div class="col-xs-6">
                                <label for="phone">
                                    <h4>Caption</h4></label>
                                <input type="text" class="form-control" name="caption" id="caption" value="<?php echo $user_resource['caption'] ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile">
                                    <h4>Website</h4></label>
                                <input type="text" class="form-control" name="website" id="website" value="<?php echo $user_resource['website'] ?>" >
                            </div>
                        </div>
						
						
						
						<div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile">
                                    <h4>Address</h4></label>
                              
								<textarea class="form-control" name="addr" id="addr" cols="40" rows="5" text="<?php echo $user_resource['addr'] ?>"> <?php echo $user_resource['addr'] ?> </textarea>
                            </div>
                        </div>
						
						<div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile">
                                    <h4>Info</h4></label>
                              
								<textarea class="form-control" name="info" id="info" cols="40" rows="5" text="<?php echo $user_resource['info'] ?>"> <?php echo $user_resource['info'] ?>  </textarea>
                            </div>
                        </div>
						
						
                        
                        <div class="form-group">
                            <div class="col-xs-12">
                                <br>
                                <button class="btn btn-lg btn-success" type="submit"><i class="glyphicon glyphicon-ok-sign"></i> Save</button>
                               
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <!--/tab-pane-->
			
			<div class="tab-pane " id="detailed">
			
		
			
			
			
			</div>
			
			
			
			
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
	                        

                        

              	  
                                                      
</script>
</body>
</html>
