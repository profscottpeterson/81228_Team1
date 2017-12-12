<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}


include '../dbconnect.php';

$userId = (int)$_SESSION['id'];

$sqlStatement = "SELECT * FROM note WHERE userid = '$userId'";
$queryResults = mysqli_query($connection, $sqlStatement);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Notable</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="stylesheet.css" media="screen">
    <link rel="icon" href="../favicon.ico" type="image/x-icon">
</head>

<body>
    <div id="wrapper">
        <header class="titleHeader">  
            <h1 class="title">Notable</h1>
        </header>
        <div class="signoutBanner">
            <form action="../logout.php" method="POST" class="signoutForm">
                <input type="submit" id="signoutbutton" value="Log Out" class="btnSignin">
            </form>
        </div>
        <main>
            <div class="boardview">
                <div id="addNote" onclick="PrintNotes()"><a><img src= "../images/printer.png" height="50px" width="50px"></a></div>
                <div id="boardview"><a href="index.php"><img src= "../images/createNote.png" height="55px" width="55px"></a></div>
                <?php 

                    if ($queryResults->num_rows > 0) {

                        //variable for clear left (start new row)
                        $counter = 1;

                        while ($note = $queryResults->fetch_assoc()) {

                            if ($counter == 1 or $counter == 5 or $counter == 9) {
                                echo
                                "<div class=\"noteBoardNote\"  style=\"clear:left; background-color:{$note['notecolor']}\">
                                   <textarea class=\"noteBoardTitle\" readonly>{$note['notetitle']}</textarea>
                                   <textarea class=\"noteBoardText\" readonly>{$note['notedetails']}</textarea>
                                </div>";  
                            } else {
                                echo
                                "<div class=\"noteBoardNote\" style=\"background-color:{$note['notecolor']}\">
                                   <textarea class=\"noteBoardTitle\" readonly>{$note['notetitle']}</textarea>
                                   <textarea class=\"noteBoardText\" readonly>{$note['notedetails']}</textarea>
                                </div>"; 
                            }

                            $counter++;
                        }
                    }
                ?>
            </div>
        </main>

    </div>
    <script type="text/javascript">
        window.jQuery || document.write('<script type="text/javascript" src="jquery.min.js"><\/script>')
    </script>
    <script>
        function PrintNotes() {
            window.print();
        }
    </script>
</body>

</html>
