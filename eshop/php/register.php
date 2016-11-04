<?php
if(isset($_POST['submit'])){
	require_once 'db_connect.php';
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	echo $sql = "INSERT INTO `users`(`name`,`email`,`password`) VALUES ('$name','$email', '$password')";
	if(mysql_query($sql)){
		header('Location: ../login.html');
	}
}


?>