<?php
$no1=0;
session_start();
include_once 'user-dbop.php';
    $objUser = new User();
    $user_resource = $objUser->log2($_SESSION['reg_no']);
    $act=$objUser->activity_log($_SESSION['reg_no']);
	$no1=mysqli_num_rows( $act );
$no=0;

//if (!isset($_SESSION))
  //  session_start();
if (empty($_SESSION['email_id'])) {
    header("location:index.php");
    exit();
} 
//else {
    

   if(isset($_POST['location']))
   {
	   $result=$objUser->searchl($_POST['location']);
	  
	    $no=mysqli_num_rows( $result );
	   
   }
	
	
//}

?>


<html>
<body>

<form action="donor.php" method="post">
Location: <input type="text" name="location" id="location"><br>
<input type="submit">
</form>

<table border="2">
  <thead>
    <tr>
      <th>Request Id</th>
      <th>Seeker Name</th>
      <th>Type of Organization</th>
	   <th>Service Required</th>
	    <th>Date</th>
	   
	  
    </tr>
  </thead>
  <tbody>
    <?php
      if( $no==0 ){
        echo '<tr><td colspan="4">No Rows Returned</td></tr>';
      }else{
        while( $row = mysqli_fetch_assoc( $result ) ){
          echo " <tr ><td>{$row['id']}</td></a><td>{$row['org_name']}</td><td>{$row['type']}</td><td>{$row['ser_type']}</td> <td>{$row['date_req']}</td><td><a href='http://google.com'>More</a></td></tr>\n";
        }
      }
    ?>
  </tbody>
</table>


<h2>Activity Log <br /> </h2>

<table border="2">
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
  <tbody>
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




</body>
</html>