<?php



     if($_POST['password1'] != $_POST['password2']){ 
	$message = 'Passwords should be same';
       echo $message;
       header( "refresh:1;url=index.php" );   

          
	} 
    else
    {
    include_once 'user-dbop.php';
    $objUser = new User();
   $id= ($objUser->reg($_POST['email1'], $_POST['password1'],$_POST['type']));
   if($_POST['type']=='D')
   {
   $msg=($objUser->reg_d($id,$_POST['email1']));
   
   }
   
    if($_POST['type']=='V')
   {
   $msg=($objUser->reg_v($id,$_POST['email1']));
   
   }
   
  
   
   if($_POST['type']=='S')
   {
   $msg=($objUser->reg_s($id,$_POST['email1']));
   
   }
   
   echo "Registration Successful";
   header( "refresh:1;url=index.php" );
   }


?>


