<?php

session_start();
include_once 'user-dbop.php';
$objUser = new User();

if (empty($_SESSION['email_id'])) {
    header("location:index.php");
    exit();
} 

//$reg_no,$org_name,$cont,$addr,$gst,$website,$type,$info,$caption
if($_SESSION['type']=='D')
{
	echo "Success";
$objUser->profile_d($_SESSION['reg_no'],$_POST['org_name'],$_POST['cont'],$_POST['addr'],$_POST['gst'],$_POST['website'],$_POST['type'],$_POST['info'],$_POST['caption']);	
 header("location:donor_profile.php");	
}


if($_SESSION['type']=='S')
{
	
$objUser->profile_s($_SESSION['reg_no'],$_POST['org_name'],$_POST['cont'],$_POST['addr'],$_POST['lic_no'],$_POST['website'],$_POST['type'],$_POST['info'],$_POST['caption']);	
	 header("location:seeker_profile.php");
}

if($_SESSION['type']=='V')
{
	
$objUser->profile_v($_SESSION['reg_no'],$_POST['org_name'],$_POST['cont'],$_POST['addr'],$_POST['lic_no'],$_POST['website'],$_POST['ser_type'],$_POST['info'],$_POST['caption']);	
	 header("location:vendor_profile.php");
}




?>