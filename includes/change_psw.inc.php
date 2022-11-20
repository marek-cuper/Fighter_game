<?php
session_start();
if (isset($_POST["submit"])) {

    $oldpsw = $_POST["oldpsw"];
    $newpsw1 = $_POST["newpsw1"];
    $newpsw2 = $_POST["newpsw2"];

    require_once 'dbb.inc.php';
    require_once 'functions.inc.php';

    if (emptyPswChange($_SESSION["name"], $oldpsw, $newpsw1, $newpsw2) !== false){
        header("location: ../settingsPage.php?error=emptyinputchng");
        exit();
    }
    changePassword($conn, $_SESSION["id"], $_SESSION["name"], $oldpsw, $newpsw1, $newpsw2);

} else {
    header("location: ../loginPage.php");
    exit();
}
