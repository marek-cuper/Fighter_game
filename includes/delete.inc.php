<?php
session_start();
if (isset($_POST["submit"])) {

    $psw = $_POST["psw"];

    require_once 'dbb.inc.php';
    require_once 'functions.inc.php';

    if (emptyInputLog($_SESSION["name"], $psw) !== false){
        header("location: ../loginPage.php?error=emptyinputdel");
        exit();
    }
    deleteUser($conn, $_SESSION["id"], $_SESSION["name"], $psw);

} else {
    header("location: ../loginPage.php");
    exit();
}