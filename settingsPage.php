<?php
session_start();
if(!isset($_SESSION["id"])){
    header("location: ../loginPage.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <link rel="stylesheet" href="css/web.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            background: url("images/backgPixelSky.jpg")
            no-repeat fixed;
            background-size:cover;
            overflow: hidden;
        }


    </style>

</head>
<body>
<div class="wholePage">
    <?php
    include_once 'sidenav.php'
    ?>
    <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
    </a>
    <div class="container">
        <div class="row">
            <div class="col">

                <div class="settingsBox">
                    <div>
                        <p>Changing password</p>
                    </div>
                    <form action="includes/change_psw.inc.php" method="post">
                        <div>
                            <input type="password" placeholder="Old password" id="oldpsw" name="oldpsw" required>
                        </div>
                        <div>
                            <input type="password" placeholder="New password" id="newpsw1" name="newpsw1" required>
                        </div>
                        <div>
                            <input type="password" placeholder="Repeat new password" id="newpsw2" name="newpsw2" required>
                        </div>
                        <?php
                        if(isset($_GET['error'])){
                            if ($_GET['error'] == "emptyinputchng"){
                                echo "<p>You must fiil all fields!</p>";
                            }
                            else if ($_GET['error'] == "passworddontmatch"){
                                echo "<p>Your new passwords dont match</p>";
                            }
                            else if ($_GET['error'] == "wrongpasswordchng"){
                                echo "<p>Wrong old password</p>";
                            }
                            else if ($_GET['error'] == "invaliId"){
                                echo "<p>Your name must consist only from a-z,A-Z or 0-9</p>";
                            }
                            else if ($_GET['error'] == "invalidEmail"){
                                echo "<p>You wrote wrong email!</p>";
                            }
                            else if ($_GET['error'] == "invalidPasswords"){
                                echo "<p>You didnt write same password</p>";
                            }
                            else if ($_GET['error'] == "nameTaken"){
                                echo "<p>Name or Email is already taken!</p>";
                            }
                            else if ($_GET['error'] == "none"){
                                echo "<p>You created new account, now you can login!</p>";
                            }

                        }
                        ?>
                        <div>
                            <button type="submit" name="submit" >Change password</button>
                        </div>
                    </form>


                    <div>
                        <p>Delete account</p>
                    </div>

                    <form action="includes/delete.inc.php" method="post">
                        <div>
                            <input type="password" placeholder="Password" id="psw" name="psw" required>
                        </div>
                        <?php
                        if(isset($_GET['error'])){
                            if ($_GET['error'] == "wrongpassworddel"){
                                echo "<p>Wrong password!</p>";
                            } else if ($_GET['error'] == "emptyinputdel"){
                                echo "<p>Empty input!</p>";
                            }
                        }
                        ?>
                        <div>
                            <button type="submit" name="submit" >Delete account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    include_once 'footer.php'
    ?>
</div>

<script>
    function myFunction() {
        var x = document.getElementById("middleNav");
        if (x.style.display === "block") {
            x.style.display = "none";
        } else {
            x.style.display = "block";
        }
    }
</script>


</body>
</html>

