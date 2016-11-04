<?php
session_start();
require_once 'db_connect.php';
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = mysql_real_escape_string($_POST['email']);
	$password =  mysql_real_escape_string($_POST['password']);
	$query = "SELECT * FROM `users` WHERE email='$email' and password='$password'";
	$result = mysql_query($query) or die(mysql_error());
	$count = mysql_num_rows($result);
	if ($count == 1){
		$token = md5(uniqid(rand(), true));
		 $sql = "update `users` set token='$token' WHERE email='$email' and password='$password'";
		mysql_query($sql);
		$query2 = "SELECT * FROM `users` WHERE email='$email' and password='$password'";
		$result2 = mysql_query($query2) or die(mysql_error());
		$user = mysql_fetch_assoc($result2);
		$_SESSION['email'] = $email;
		if ($user['user_type'] == "Buyer") {
			$user_id = $user['id'];
			$query = "SELECT * FROM `buyers` WHERE user_id='$user_id' ";
			$result = mysql_query($query);
			$buyer = mysql_fetch_assoc($result);
			$buyer['token'] = $user['token'];
			echo json_encode($buyer);

		}
		elseif ($user['user_type'] == "Seller") {
			$user_id = $user['user_id'];
			$query = "SELECT * FROM `seller` WHERE user_id='$user_id' ";
			$result = mysql_query($query);
			$seller = mysql_fetch_assoc($result);

		}


	}else{
		$error_msg['error_msg'] = "Invalid Login Credentials.";
		echo json_encode($error_msg);
	}

}
?>