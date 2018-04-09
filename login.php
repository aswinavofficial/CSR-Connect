<?php



   echo "1";

    echo "hi";
	include_once 'user-dbop.php';
	
    $objUser = new User();
    $objUser->login($_POST['email_id'], $_POST['password']);
	
	
	


echo $_POST['email_id'];

?>