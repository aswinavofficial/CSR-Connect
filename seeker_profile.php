<?php
session_start();
$no=0;
$no1=0;
$no2=0;
//echo $_SESSION['email_id'];
//echo $_SESSION['reg_no'];

if (empty($_SESSION['email_id'])) {
    header("location:index.php");
    exit();
} 

    include_once 'user-dbop.php';
    $objUser = new User();
    $user_resource = $objUser->log_s($_SESSION['reg_no']);

   $act=$objUser->activity_log_seeker($_SESSION['reg_no']);
   //echo $_SESSION['reg_no'];
   $his=$objUser->history_seeker($_SESSION['reg_no']);
   	$no1=mysqli_num_rows( $act );
   $no2=mysqli_num_rows( $his );


   if(isset($_POST['brief']))
   {
	  
	  
	 $result=$objUser->request($_SESSION['reg_no'],$_SESSION['email_id'],$_POST['ser_type'],$_POST['location'],$_POST['brief'],$_POST['detailed']);
	  
	 
	 
	   
	   
   }
	
	


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
            <h1><?php echo $user_resource['org_name']; ?></h1></div>
        <div class="col-sm-2">
            <a href="/users" class="pull-right"><img title="profile image" class="img-circle img-responsive" src="https://bootdey.com/img/Content/avatar/avatar1.png"></a>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <!--left col-->

            <ul class="list-group">
                <li class="list-group-item text-muted">Profile</li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Email Id</strong></span><?php echo $user_resource['email_id']; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Contact</strong></span> <?php echo $user_resource['cont']; ?></li>
                <li class="list-group-item text-right"><span class="pull-left"><strong>Address</strong></span><?php echo $user_resource['addr']; ?> </li>

            </ul>

            <div class="panel panel-default">
                <div class="panel-heading">Website <i class="fa fa-link fa-1x"></i></div>
                 <div class="panel-body"><a href="http://<?php echo $user_resource['website'] ?>"><?php echo $user_resource['website'] ?></a></div>
            </div>

            

            

        </div>
        <!--/col-3-->
        <div class="col-sm-9">

            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#request" data-toggle="tab">Request</a></li>
                <li><a href="#activity" data-toggle="tab">Activity Log</a></li>
				<li><a href="#hist" data-toggle="tab">History</a></li>
                <li><a href="#settings" data-toggle="tab">Settings</a></li>
				<li><a href="logout.php" >Logout</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="request">
                    
                    <form action="seeker_profile.php" method="post">

         <br/>   <br/>  <br/>
		 
         
               <input type="text" id="brief" name="brief" placeholder="Request Title..."> <br/>   <br/>  <br/>
          
		   
         
               <input type="text" id="ser_type" name="ser_type" placeholder="Type..."> <br/> <br/>   <br/>
          
		   
         
               <input type="text" id="location" name="location" placeholder="Location..."> <br/>  <br/>  <br/>
          
		 
		  
           
				
                
                 <textarea id="detailed" name="detailed" placeholder="Request Details..."></textarea> <br/>  <br/>  <br/>
                  
                   <input type="submit" value="submit">
                    </form>

                    <hr>

                </div>
                <!--/tab-pane-->
                <div class="tab-pane" id="activity">

                    <h2></h2>
					
                     <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                               <tr>
	                          <th>Transaction Id</th>
                               <th>Request Id</th>
                                <th>Donor </th>
							    <!--<th>Vendor </th>-->
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
                                       echo " <tr><td>{$row['trans_id']}</td><td>{$row['req_id']}</td><td>{$row['org_name']}</td>  <td>{$row['ser_type']}</td> <td>{$row['open_date']}</td> <td>{$row['status']}</td><td><a href='rating.php?trans_id=$trans_id&status=1'>ACKNOWLEDGE</a></td><td><a href='rating.php?trans_id=$trans_id&status=0'>NOT RECIEVED</a></td></tr>\n";
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
				   <div class="tab-pane" id="hist">

                    <h2></h2>
					
					 <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                               
                                <th>Request Id</th>
								<th>Summary</th>
                                
								<th>Location</th>
	                            
	                            
								 <th>Service Required</th>
								 
								 <th>Date</th>
								
	   
	  
                                  </tr>
                            </thead>
                            <tbody id="items">
                                <?php
                              if( $no2==0 ){
                                 echo '<tr><td colspan="4">No Rows Returned</td></tr>';
                                 }else{
                                while( $row = mysqli_fetch_assoc( $his ) ){
									$req_id=$row['id'];
                               echo " <tr ><td>{$row['id']}</td><td>{$row['brief']}</td><td>{$row['location']}</td><td>{$row['ser_type']}</td><td>{$row['date_req']}</td></tr>\n";
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
