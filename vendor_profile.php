<?php
$no1=0;
$no2=0;
$no=0;
session_start();
include_once 'user-dbop.php';
    $objUser = new User();
	$result=$objUser->display();
	$no=mysqli_num_rows( $result );
    $user_resource = $objUser->logv($_SESSION['reg_no']);
	
    $act=$objUser->activity_logv($_SESSION['reg_no']);
	$his=$objUser->historyv($_SESSION['reg_no']);
	$no1=mysqli_num_rows( $act );
	$no2=mysqli_num_rows( $his );


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
    <style type="text/css">
    	body{margin-top:20px;}                                                                    
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
                <li class="list-group-item text-right"><span class="pull-left"><strong>Address </strong></span> <?php echo $user_resource['addr'] ?></li>
                

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
			
			

            

        </div>
        <!--/col-3-->
        <div class="col-sm-9">

            <ul class="nav nav-tabs" id="myTab">
               <!-- <li class="active"><a href="#search" data-toggle="tab">Requests</a></li>-->
                <li class="active"><a href="#activity" data-toggle="tab">Activity Log</a></li>
				<li><a href="#history" data-toggle="tab">History</a></li>
                <li><a href="#settings" data-toggle="tab">Profile</a></li>
				<li><a href="logout.php" >Logout</a></li>
            </ul>

            <div class="tab-content">
			
			   
				
				
				
				
                <div class="tab-pane active" id="activity">
				    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                               <tr>
	                          
							   <th>Donor Name</th>
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
										  $trans_id=$row['trans_id'];
										  $id=$row['req_id'];
                                       echo " <tr><td>{$row['d_org_name']}</td><td>{$row['org_name']}</td><td>{$row['location']}</td> <td>{$row['type']}</td> <td>{$row['ser_type']}</td> <td>{$row['open_date']}</td> <td>{$row['status']}</td><td><a href='detailed_v.php?id=$id&trans_id=$trans_id'>More</a></td></tr>\n";
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
                <!--/tab-pane-->
                <div class="tab-pane" id="history">

                    <h2></h2>
					
					 <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                               <tr>
                           <th>Transaction Id</th>
                           <th>Request Id</th>
						   <th>Donor Name</th>
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
                                  echo " <tr><td >{$row['trans_id']}</td><td >{$row['req_id']}</td ><td>{$row['d_org_name']}</td> <td>{$row['org_name']}</td><td >{$row['location']}</td> <td >{$row['type']}</td> <td >{$row['ser_type']}</td> <td >{$row['open_date']}</td> <td >{$row['status']}</td></tr>\n";
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
                                    <h4>License Number</h4></label>
                                <input type="text" class="form-control" name="lic_no" id="lic_no" value="<?php echo $user_resource['lic_no'] ?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-6">
                                <label for="mobile">
                                    <h4>Service Type</h4></label>
                                <input type="text" class="form-control" name="ser_type" id="ser_type" value="<?php echo $user_resource['ser_type'] ?>" >
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
