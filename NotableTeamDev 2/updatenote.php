<?php
session_start();
include 'dbconnect.php';


$notekey = (int)$_POST['notekey'];
$userId = (int)$_SESSION['id'];
$noteTitle = $_POST['noteTitle'];
$noteDetails = $_POST['noteDetails'];
$noteColor = $_POST['noteColor'];

$sqlStatement = "SELECT * FROM note WHERE noteid = '$notekey' AND userid = '$userId'";
$queryResults = $connection->query($sqlStatement);

if (!$record = $queryResults->fetch_assoc()) {

    $sqlStatement1 = 
        "INSERT INTO 
            note 
            (noteid
            ,userid
            ,notetitle
            ,notedetails
            ,notecolor)
        VALUES 
            ('$notekey'
            ,'$userId'
            ,'$noteTitle'
            ,'$noteDetails'
            ,'$noteColor')";
    
    $queryResults1 = mysqli_query($connection, $sqlStatement1);
    
} else {
    
    $sqlStatement2 = 
        "UPDATE 
            note 
        SET 
            notetitle = '$noteTitle', 
            notedetails = '$noteDetails',
            notecolor = '$noteColor'
        WHERE 
            noteid = '$notekey' 
            AND userid = '$userId'";

    $queryResults2 = mysqli_query($connection, $sqlStatement2);

}