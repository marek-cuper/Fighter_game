<?php

if (isset($_POST["submit"])) {

    $name = $_POST["name"];
    $email = $_POST["email"];
    $psw1 = $_POST["psw1"];
    $psw2 = $_POST["psw2"];



    require_once 'dbb.inc.php';
    require_once 'functions.inc.php';


    if (emptyInputReg($name, $email, $psw1, $psw2) !== false){
        header("location: ../loginPage.php?error=emptyInputReg");
        exit();
    }
    if ((invaliCharacters($name) || invaliCharacters($psw1) || invaliCharacters($psw2)) !== false){
        header("location: ../loginPage.php?error=invalidCharactersReg");
        exit();
    }
    if (invalidSizeName($name) !== false){
        header("location: ../loginPage.php?error=invalidSizeNameReg");
        exit();
    }
    if (invalidEmail($email) !== false){
        header("location: ../loginPage.php?error=invalidEmail");
        exit();
    }
    if ((invalidSizePassword($psw1) || invalidSizePassword($psw2)) !== false){
        header("location: ../loginPage.php?error=invalidSizesPasswordReg");
        exit();
    }
    if (pswMatch($psw1, $psw2) !== false){
        header("location: ../loginPage.php?error=invalidPasswords");
        exit();
    }
    if (idExist($conn, $name, $email) !== false){
        header("location: ../loginPage.php?error=nameTaken");
        exit();
    }
    createUser($conn, $name, $email, $psw1);


} else {
    header("location: ../loginPage.php");
    exit();
}