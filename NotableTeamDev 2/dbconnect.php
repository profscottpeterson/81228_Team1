<?php
$connection = mysqli_connect("localhost", "rschulz", "", "rschulz");

if (!$connection) {
    die("The connection has failed: ".mysql_connect());
}