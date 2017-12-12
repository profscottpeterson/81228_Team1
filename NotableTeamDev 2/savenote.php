<?php
session_start();
include 'dbconnect.php';

$noteId = $_POST['notekey'];
$userId = $_SESSION['id'];
$noteTitle = $_POST['noteTitle'];
$noteDetails= $_POST['noteDetails'];

$sqlStatement = "INSERT INTO note (noteid, userid, notetitle, notedetails)
VALUES ('$noteId', '$userId', '$noteTitle', '$noteDetails')";

$queryResults = mysqli_query($connection, $sqlStatement);

