<?php
session_start();
include_once 'user-dbop.php';
$objUser = new User();

if (empty($_SESSION['email_id'])) {
    header("location:index.php");
    exit();
} 
    $trans_id=$_GET['trans_id'];
	 $vtrans_id=$_GET['vtrans_id'];
	 $req_id=$_GET['req_id'];
	 $_SESSION['trans_id']=$trans_id;
	 $_SESSION['vtrans_id']=$vtrans_id;
	 
	
   //$resources = $objUser->details_v($req_id);
   $resources=$objUser->details_vndr($req_id,$_SESSION['dno']);
  // $_SESSION['regv']=$resources['reg_no'];
  // $services=$objUser->details_type($_GET['id']);
  // $ser_type=$services['ser_type'];
  // $_SESSION['req_id']=$_GET['id'];


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
    
  </div>
  
  <div class="row">
  
    
  
  
  <div " class="col-sm-3 col-md-6">
  <div class="panel panel-default">
    <div align="center" class="panel-heading" align="center">
	
	<form action="transaction.php" method="get">
    
	<input type="submit" name="submit" value="OK" />
     </form>
	</div>  
	</div>
   
  </div>
  
   <div " class="col-sm-3 col-md-6">
  <div class="panel panel-default">
    <div align="center" class="panel-heading" align="center">
	
	<form action="transaction.php" method="get">
    
	<input type="submit" name="submit" value="REJECT" />
     </form>
	</div>  
	</div>
   
  </div>
  
  
  </div>
</div>

</body>
</html>
