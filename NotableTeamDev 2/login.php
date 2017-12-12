<?php
session_start();
include 'dbconnect.php';

$username = $_POST['usernameli'];
$password = $_POST['passwordli'];


$sqlStatement = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
$queryResults = $connection->query($sqlStatement);

if (!$record = $queryResults->fetch_assoc()) {
    echo "Username and password are not a match.  Try again.";
} else {
    $_SESSION['id'] = $record['userid'];
    header("Location: userportal/index.php");
}



