<?php

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $psw = $_POST["psw"];

    require_once 'dbb.inc.php';
    require_once 'functions.inc.php';

    if ((invaliCharacters($name) || invaliCharacters($psw)) !== false){
        header("location: ../loginPage.php?error=invalidCharactersLog");
        exit();
    }
    if (emptyInputLog($name,$psw) !== false){
        header("location: ../loginPage.php?error=emptyinputlog");
        exit();
    }
    loginUser($conn, $name, $psw);

} else {
    header("location: ../loginPage.php");
    exit();
}

