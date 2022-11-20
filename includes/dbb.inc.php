//dbb.inc.php
<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "dtb456";
$dBName = "game";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (! $conn) {
    die("Connection failed" . mysqli_connect_error());
}

