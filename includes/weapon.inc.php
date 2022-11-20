<?php
session_start();

if (isset($_POST["submit"])) {


    require_once 'dbb.inc.php';
    require_once 'functions.inc.php';


    chooseWeapon($conn, $_SESSION["weapon_image_link"]);
    giveSessionWeaponLink($conn, $_SESSION["name"]);


} else {
    header("location: ../weaponPage.php");
    exit();
}