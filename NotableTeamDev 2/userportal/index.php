<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: ../index.php");
}


include '../dbconnect.php';

$userId = (int)$_SESSION['id'];

$sqlStatement = "SELECT * FROM note WHERE userid = '$userId'";
$queryResults1 = mysqli_query($connection, $sqlStatement);
$queryResults2 = mysqli_query($connection, $sqlStatement);

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
					<input type="submit" onclick="SaveLastNote()" id="signoutbutton" value="Log Out" class="btnSignin">
				</form>
        </div>
        
        <nav class="leftColumn">
            <div id="addNote" onclick="addNote()"><a><img src= "../images/newNote.png" height="50px" width="50px"></a></div>
            <div id="boardview" onclick="SaveLastNote()"><a href="boardview.php"><img src= "../images/noteBoard.png" height="55px" width="55px"></a></div>
            <ul id="noteNav">
                <?php                        
                    if ($queryResults1->num_rows > 0) {
                        while ($notetab = $queryResults1->fetch_assoc()) {
                            echo "<li id=\"note{$notetab['noteid']}\" class=\"noteLink\" onclick=\"openNote(event, 'Note {$notetab['noteid']}')\" style=\"border-color:{$notetab['notecolor']}\">{$notetab['notetitle']}<a class=\"x\" onclick=\"deleteNote(this)\"><img src= \"../images/trashicon.png\" height=\"18px\" width=\"18px\" style=\"float:right\"></a></li>";                            
                        }
                    } else {
                        echo "<li id=\"note1\" class=\"noteLink\" onclick=\"openNote(event, 'Note 1')\" style=\"border-color:#FBEF65\">New Note<a class=\"x\" onclick=\"deleteNote(this)\"><img src= \"../images/trashicon.png\" height=\"18px\" width=\"18px\" style=\"float:right\"></a></li>";                        
                    }
                ?>
            </ul>
            
        </nav>

        <main>
            <div class="rightColumn">
                <div id="changeColor">
                    <div id="YellowColor" onclick="yellow()">
                        <a></a>
                    </div>
                    <div id="BlueColor" onclick="blue()">
                        <a></a>
                    </div>
                    <div id="PinkColor" onclick="pink()">
                        <a></a>
                    </div>
                    <div id="CustomColor" onclick="pickColor()">
                        <a></a>
                        <input type='color' name="colorPicker" value="#FBEF65" id="colorPicker" title="Color">
                    </div>
                </div>
                <?php
                    if ($queryResults2->num_rows > 0) {
                        while ($note = $queryResults2->fetch_assoc()) {
                            echo "<div id= \"Note {$note['noteid']}\" class=\"note\" data-notekey=\"{$note['noteid']}\" style=\"background-color:{$note['notecolor']}\">
                                <textarea class=\"noteTitle\" maxlength=\"10\" oninput=\"updateTab(this)\" placeholder=\"New Note\">{$note['notetitle']}</textarea>
                                <textarea class=\"noteText\" maxlength=\"84\" placeholder=\"Note details\">{$note['notedetails']}</textarea>
                            </div>";
                        }
                    } else {
                        echo "<div id= \"Note 1\" class=\"note\" data-notekey=\"1\" style=\"background-color:#FBEF65\">
                            <textarea class=\"noteTitle\" maxlength=\"10\" oninput=\"updateTab(this)\" placeholder=\"New Note\"></textarea>
                            <textarea class=\"noteText\" maxlength=\"84\" placeholder=\"Note details\"></textarea>
                        </div>";
                    }
                ?>
            </div>
        </main>

    </div>
    <script type="text/javascript">
        window.jQuery || document.write('<script type="text/javascript" src="jquery.min.js"><\/script>')
    </script>
    <script src="sticky.js"></script>
</body>

</html>
