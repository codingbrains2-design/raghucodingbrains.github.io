<?php
session_start();
require_once 'db_connect.php';

if(isset($_POST['user_id']) && isset($_POST['old_password']) && isset($_POST['new_password'])){
	$user_id = $_POST['user_id'];
	$old_password = $_POST['old_password'];
	$new_password = $_POST['new_password'];

	$query = "SELECT * FROM `users` WHERE id =  '$user_id' ";
	$result = mysql_query($query) or die(mysql_error());
	$user = mysql_fetch_assoc($result);

	if($old_password != $user['password']){
		$error_msg['error_msg'] = "Incorrect Old Password";
		echo json_encode($error_msg);
	}
	else{
		$query = "UPDATE `users` set password = '$new_password'  WHERE id =  '$user_id' ";
		if(mysql_query($query)){
			$error_msg['success_msg'] = "changed";
			echo json_encode($error_msg);
		}
	}



}
else{
	$error_msg['error_msg'] = "insufficient paramerts";
	echo json_encode($error_msg);
	
}
?>