<?php
session_start();
include 'dbconnect.php';

$firstname = $_POST['firstnamesu'];
$lastname = $_POST['lastnamesu'];
$email = $_POST['emailsu'];
$username = $_POST['usernamesu'];
$password = $_POST['passwordsu'];

if (strlen($username) < 8 or strlen($password) < 8) {
	echo "Username and password must be at least 8 characters in length.  Please try again.";
} else {
	//check for same username
	$sqlStatement1 = "SELECT * FROM user WHERE username = '$username'";
	$queryResults1 = $connection->query($sqlStatement1);
	if (!$record = $queryResults1->fetch_assoc()) {

		//if no user has username already, create one
   		$sqlStatement2 = "INSERT INTO user (firstname, lastname, email, username, password)
   		VALUES ('$firstname', '$lastname', '$email', '$username', '$password')";

		$queryResults2 = mysqli_query($connection, $sqlStatement2);

		//search for user and login
		$sqlStatement3 = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";

		$queryResults3 = $connection->query($sqlStatement3);

		if (!$record = $queryResults3->fetch_assoc()) {
    		echo "You are not logged in.";
		} else {
  	    	$_SESSION['id'] = $record['userid'];
  	  		header("Location: userportal/index.php");
		}
	} else {
    	echo "Username already chosen.  Please try again.";
	}
}







