<?php
session_start();
include_once 'user-dbop.php';
$objUser = new User();

if (empty($_SESSION['email_id'])) {
    header("location:index.php");
    exit();
} 

   $resources = $objUser->details_d($_GET['trans_id']);
   $resources1 = $objUser->details($resources['req_id']);
   $_SESSION['dregno']=$resources['regd'];
   $_SESSION['req_id']=$_GET['id'];
   $_SESSION['trans_id']=$_GET['trans_id'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title> Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<style>
<style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>

</style>


<body>
 
<div class="container">
 <?php 
$i=0;
for($i=0;$i<8;$i++)
  echo "<br/>";


   ?>  
   
<div class="row">
    <div  class="col-sm-3 col-md-6">
  
  <div class="panel panel-default">
    <div align="center" class="panel-heading" align="center"><h2><?php echo $resources['brief']; ?></h2></div>  
    <div class="panel-body">
	
	<h3>
	<table style="width:100%">
  <tr>
    <th>Service Type </th>
    <td><?php  echo $resources['ser_type'];  ?></td>
  </tr>
  <tr>
    <th >Location </th>
    <td><?php  echo $resources['location'];  ?></td>
  </tr>
  
  
  <tr>
    <th >Date </th>
    <td><?php  echo $resources['date_req'];  ?></td>
  </tr>
  
   <tr>
    <th >Details </th>
    <td><?php  echo $resources['detailed'];  ?></td>
  </tr>
  
  
</table>
	
	</h3>
	
	</div>
  </div>
    </div>
	
	
	
	 <div " class="col-sm-3 col-md-6">
  
  <div class="panel panel-default">
    <div class="panel-heading" align="center"><h2><?php echo $resources['org_name']; ?></h2></div>
    <div class="panel-body">
	

	
	<h3>
	<table style="width:100%">
  <tr>
    <th>Email Id </th>
    <td><?php  echo $resources['email_id'];  ?></td>
  </tr>
  <tr>
    <th >Website </th>
    <td><?php  echo $resources['website'];  ?></td>
  </tr>
  
  
  <tr>
    <th >Contact </th>
    <td><?php  echo $resources['cont'];  ?></td>
  </tr>
  
   <tr>
    <th >Type </th>
    <td><?php  echo $resources['type'];  ?></td>
  </tr>
  
  <tr>
    <th >Info </th>
    <td><?php  echo $resources['info'];  ?></td>
  </tr>
  
  <tr>
    <th >Address </th>
    <td><?php  echo $resources['addr'];  ?></td>
  </tr>
</table>
	
	</h3>
	
	
	
	
	
	</div>
  </div>
    </div>
	
	
		 <div " class="col-sm-3 col-md-6">
  
  <div class="panel panel-default">
    <div class="panel-heading" align="center"><h2><?php echo $resources1['org_name']; ?></h2></div>
    <div class="panel-body">
	

	
	<h3>
	<table style="width:100%">
  <tr>
    <th>Email Id </th>
    <td><?php  echo $resources1['email_id'];  ?></td>
  </tr>
  <tr>
    <th >Website </th>
    <td><?php  echo $resources1['website'];  ?></td>
  </tr>
  
  
  <tr>
    <th >Contact </th>
    <td><?php  echo $resources1['cont'];  ?></td>
  </tr>
  
   <tr>
    <th >Type </th>
    <td><?php  echo $resources1['type'];  ?></td>
  </tr>
  
  <tr>
    <th >Info </th>
    <td><?php  echo $resources1['info'];  ?></td>
  </tr>
  
  <tr>
    <th >Address </th>
    <td><?php  echo $resources1['addr'];  ?></td>
  </tr>
</table>
	
	</h3>
	
	
	
	
	
	</div>
  </div>
    </div>
    
  </div>
  
  <div class="row">
   <div " class="col-sm-3 col-md-6">
  <div class="panel panel-default">
    <div align="center" class="panel-heading" align="center">
	
	<form action="transaction.php">
    <input type="submit" name="submit" value="READY" /> 
	
     </form>
	</div>  
	</div>
   
  </div>
  
  
  </div>
</div>

</body>
</html>
