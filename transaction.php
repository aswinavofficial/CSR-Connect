<?php

session_start();
include_once 'user-dbop.php';
$objUser = new User();

if (empty($_SESSION['email_id'])) {
    header("location:index.php");
    exit();
} 

  
 
if($_GET['submit']=='ACCEPT')
       {
		   $resources = $objUser->details($_SESSION['req_id']); 
	
		 
   
	    $transid=$objUser->trans_d($_SESSION['req_id'], $resources['reg_no'],$_SESSION['reg_no'],'IN PROGRESS');
		
	    echo "Transaction Completed Successfully <br/> Transaction Id : $transid";
		header( "refresh:1.5;url=donor_profile.php" );
	
	
        }
		
		
		if($_GET['submit']=='INTERESTED')
       {
		    $resources = $objUser->details($_SESSION['req_id']);
		 
		 
   
	   $transid=$objUser->trans_d($_SESSION['req_id'], $resources['reg_no'],$_SESSION['reg_no'],'WAITING');
		
	    echo "Notification send to all vendors";
		header( "refresh:1.5;url=donor_profile.php" );
		
	   }
	   
	   if($_GET['submit']=='READY')
	   {
		   $transid=$objUser->trans_v($_SESSION['trans_id'],$_SESSION['reg_no'],$_SESSION['dregno']);
		   echo "Acknowledgment send to Donor";
		header( "refresh:1.5;url=vendor_profile.php" );
		   
	   }
	   
	   if($_GET['submit']=='OK')
	   {
		   
		  $vtrans_id=$objUser->trans_ok($_SESSION['trans_id'],$_SESSION['vtrans_id'],'ACCEPT');
		  $trans_id=$objUser->trans_update_donor($_SESSION['trans_id'],2,$_SESSION['dno']);
          echo "Transaction completed successfully <br/> Transaction Id : $trans_id";
		  header( "refresh:1.5;url=donor_profile.php" );

		   
	   }
	   
	   
	   if($_GET['submit']=='REJECT')
	   {
		  $vtrans_id=$objUser->trans_ok($_SESSION['trans_id'],$_SESSION['vtrans_id'],'REJECT'); 
		   echo "Request successfully rejected";
		  header( "refresh:1.5;url=donor_profile.php" );
	   }
	
	
        


?>