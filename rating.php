<?php

session_start();
include_once 'user-dbop.php';
$objUser = new User();

if (empty($_SESSION['email_id'])) {
    header("location:index.php");
    exit();
} 

   
  
  
$objUser->trans_update($_GET['trans_id'],$_GET['status']);
	    header("location:seeker_profile.php");
   
	   
   
   
   ?>