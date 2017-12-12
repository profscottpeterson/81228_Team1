<?php
session_start();
include 'dbconnect.php';


$notekey = (int)$_POST['notekey'];

$userId = (int)$_SESSION['id'];

$sqlStatement = "DELETE FROM note WHERE noteid = '$notekey' AND userid = '$userId'";

$queryResults = mysqli_query($connection, $sqlStatement);




