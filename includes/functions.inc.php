<?php
function emptyInputReg($name, $email, $psw1, $psw2){
    $result;
    if(empty($name) || empty($email) || empty($psw1) || empty($psw2)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyPswChange($name, $oldpsw,  $psw1, $psw2){
    $result;
    if(empty($name) || empty($oldpsw) || empty($psw1) || empty($psw2)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invaliCharacters($variable){
    $result = false;
    if(!preg_match("/^[a-zA-Z0-9]*$/", $variable)){
        $result = true;
    }
    return $result;
}

function invalidSizeName($name){
    $result = false;
    if(strlen($name) < 4 || strlen($name) > 20){
        $result = true;
    }
    return $result;
}

function invalidSizePassword($psw){
    $result = false;
    if(strlen($psw) < 8 || strlen($psw) > 20){
        $result = true;
    }
    return $result;
}

function invalidEmail($email){
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true;
    }
    return $result;
}
function pswMatch($psw1, $psw2){
    $result = false;
    if($psw1 !== $psw2){
        $result = true;
    }
    return $result;
}
function idExist($conn, $name, $email){
    $sql = "SELECT * FROM user WHERE name = ? OR email = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../loginPage.php?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $name, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}
function createUser($conn, $name, $email, $psw1){
    $weaponId = 0;
    $sql = "INSERT INTO user( name, email, password, weapon_id) VALUES (?, ?, ?, ?);";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../loginPage.php?error=stmtfailed");
        exit();
    }

    $hashpassw = password_hash($psw1, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $hashpassw, $weaponId);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);
    header("location: ../loginPage.php?error=none");
    exit();


}

function emptyInputLog($name, $psw){
    $result;
    if(empty($name) || empty($psw)){
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $name, $psw){
    $idExist = idExist($conn, $name, $name);
    if($idExist === false){
        header("location: ../loginPage.php?error=wronglogin");
        exit();
    }

    $hashpassw = $idExist["password"];
    $checkPassw = password_verify($psw, $hashpassw);

    if($checkPassw === false){
        header("location: ../loginPage.php?error=wronglogin");
        exit();
    } else if ($checkPassw === true){
        session_start();
        $_SESSION["id"] = $idExist["id"];
        $_SESSION["name"] = $idExist["name"];
        $_SESSION["weapon_id"] = $idExist["weapon_id"];
        giveSessionWeaponLink($conn, $_SESSION["name"]);

        mysqli_close($conn);

        header("location: ../index.php");
        exit();
    }
}

function deleteUser($conn, $id, $name, $psw){
    $idExist = idExist($conn, $name, $name);

    $hashpassw = $idExist["password"];
    $checkPassw = password_verify($psw, $hashpassw);

    if($checkPassw === false){
        header("location: ../settingsPage.php?error=wrongpassworddel");
        exit();
    } else if ($checkPassw === true){

        $sql = "DELETE FROM user WHERE id=$id;";
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }

        mysqli_close($conn);


        session_start();
        session_unset();
        session_destroy();
        header("location: ../index.php");
        exit();
    }
}

function changePassword($conn, $id, $name, $oldpsw, $newpsw1, $newpsw2){
    $idExist = idExist($conn, $name, $name);

    if($newpsw1 !== $newpsw2){
        header("location: ../settingsPage.php?error=passworddontmatch");
        exit();
    }
    $hasholdpassw = $idExist["password"];
    $checkPassw = password_verify($oldpsw, $hasholdpassw);



    if($checkPassw === false){
        header("location: ../settingsPage.php?error=wrongpasswordchng");
        exit();
    } else if ($checkPassw === true){

        $hasholdnewpassw = password_hash($newpsw1, PASSWORD_DEFAULT);
        $sql = "UPDATE user SET password='$hasholdnewpassw' WHERE id=$id;";
        if (mysqli_query($conn, $sql)) {
            echo "Record deleted successfully";
        } else {
            echo "Error deleting record: " . mysqli_error($conn);
        }
        mysqli_close($conn);


        header("location: ../includes/logout.inc.php");
        exit();
    }
}

function giveSessionWeaponLink($conn, $name){

    $weaponID =  $_SESSION["weapon_id"];

    $sql = "SELECT weapon_link FROM weapons WHERE id = $weaponID ;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $_SESSION["weapon_link"] = $row["weapon_link"];
        }
    }
}

function returnWeaponList($conn){


    $sql = "SELECT id, weapon_link, weapon_info FROM weapons ;";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
//            $_SESSION["weapon_link"] = $row["weapon_link"];
            echo ($row["id"] + "|" + $row["weapon_link"] + "|" + $row["weapon_info"]);
        }
    }
}

