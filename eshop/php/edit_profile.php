<?php
session_start();
require_once 'db_connect.php';

if(isset($_POST['user_id'])){

	$user_id = $_POST['user_id'];

	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$address_1 = $_POST['address_1'];
	$address_2 = $_POST['address_2'];
	$city = $_POST['city'];
	$zip = $_POST['zip'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$contact = $_POST['phone'];

	
	$query = "UPDATE `buyers` set fname = '$fname',lname = '$lname',address_1 = '$address_1',address_2 = '$address_2',city = '$city',zip = '$zip',state = '$state',country = '$country',contact = '$contact'  WHERE user_id =  '$user_id' ";
	if(mysql_query($query)){
		$error_msg['success_msg'] = "Updated";
		echo json_encode($error_msg);
	}
}
else{
	$error_msg['error_msg'] = "insufficient paramerts";
	echo json_encode($error_msg);

}
?>