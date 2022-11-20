<!DOCTYPE html>
<html lang="eng">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/web.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            background: url("images/backgPixelSky.jpg")
            no-repeat fixed;
            background-size:cover;
            padding-top: 45px;
            padding-bottom: 10px;
        }

    </style>
</head>
<body>

<div class="loginnav">
    <a class="navName">Magic e-World</a>
    <div class="login-box">
        <form name="logForm" action="includes/login.inc.php" onsubmit="return validateLogin()" method="post">
            <input type="text" placeholder="Username" name="name" >
            <input type="password" placeholder="Password" name="psw" >
            <button type="submit" name="submit" >Login</button>
        </form>
        <?php
        if(isset($_GET['error'])){
            if ($_GET['error'] == "emptyinputlog"){
                echo "<p>You must fill all fields!</p>";
            }
            else if ($_GET['error'] == "wronglogin"){
                echo "<p>You wrote wrong name or password</p>";
            }else if ($_GET['error'] == "invalidCharactersLog"){
                echo "<p>Your name and password must consist only from<br> a-z,A-Z or 0-9</p>";
            }
        }
        ?>
    </div>
</div>

<div class="registration">
    <div class="row">
        <div class="col">
            <div class="regBox">
                <form name="regForm" action="includes/register.inc.php" onsubmit="return validateRegister()" method="post">
                    <div>
                        <input type="text" placeholder="Username" name="name" >
                    </div>
                    <div>
                        <input type="text" placeholder="Email" name="email" >
                    </div>
                    <div>
                        <input type="password" placeholder="Password" id="psw1" name="psw1" >
                    </div>
                    <div>
                        <input type="password" placeholder="Repeat Password" id="psw2" name="psw2" >
                    </div>
                    <div class>
                        Show password<input class="checkbox" type="checkbox" onclick="checkBoxfunc()">
                    </div>
                    <div>
                        <?php
                        if(isset($_GET['error'])){
                            if ($_GET['error'] == "emptyInputReg"){
                                echo "<p>You must fill all fields!</p>";
                            }
                            else if ($_GET['error'] == "invalidCharactersReg"){
                                echo "<p>Your name and password<br> must consist<br> only from a-z,A-Z or 0-9</p>";
                            }
                            else if ($_GET['error'] == "invalidSizeNameReg"){
                                echo "<p>Your name must 8-20 characters</p>";
                            }
                            else if ($_GET['error'] == "invalidEmail"){
                                echo "<p>You wrote wrong email!</p>";
                            }
                            else if ($_GET['error'] == "invalidSizesPasswordReg"){
                                echo "<p>Your password must 8-20 characters</p>";
                            }
                            else if ($_GET['error'] == "invalidPasswords"){
                                echo "<p>You didnt write same password</p>";
                            }
                            else if ($_GET['error'] == "nameTaken"){
                                echo "<p>Name or Email<br> is already taken!</p>";
                            }
                            else if ($_GET['error'] == "none"){
                                echo "<p>You created new account,<br> now you can login!</p>";
                            }
                        }
                        ?>
                    </div>
                    <div>
                        <button type="submit" name="submit" >Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    function onlyLettersAndNumbers(str) {
        return /^[A-Za-z0-9]*$/.test(str);
    }
    function validateEmail(email) {
        const res = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return res.test(String(email).toLowerCase());
    }
    function validateLogin() {
        let name = document.forms["logForm"]["name"].value;
        let psw = document.forms["logForm"]["psw"].value;
        if (name == "" || psw == "" ) {
            alert("All fields must be filled out");
            return false;
        }
        if ((name.length < 4 || name.length > 14) || (psw.length < 4 || psw.length > 14)) {
            alert("Name and password must have 4-14 characters ");
            return false;
        }
        if ((!onlyLettersAndNumbers(name)) || (!onlyLettersAndNumbers(psw))) {
            alert("Name and password must consist only from letters and numbers");
            return false;
        }
    }

    function validateRegister(){
        let name = document.forms["regForm"]["name"].value;
        let email = document.forms["regForm"]["email"].value;
        let psw1 = document.forms["regForm"]["psw1"].value;
        let psw2 = document.forms["regForm"]["psw2"].value;
        if (name == "" || email == "" || psw1 == "" || psw2 == "" ) {
            alert("All fields must be filled out");
            return false;
        }
        if ((name.length < 4 || name.length > 14) || (psw1.length < 8 || psw1.length > 20)) {
            alert("Name and password must have 8-20 characters ");
            return false;
        }
        if (psw1 !== psw2) {
            alert("Passwords doesnt match");
            return false;
        }
        if (!validateEmail(email)) {
            alert("Email is not valid");
            return false;
        }
        if ((!onlyLettersAndNumbers(name)) || (!onlyLettersAndNumbers(psw1))) {
            alert("Name and passwords must consist only from letters and numbers");
            return false;
        }
    }

    function checkBoxfunc() {
        var x = document.getElementById("psw1");
        var y = document.getElementById("psw2");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
        if (y.type === "password") {
            y.type = "text";
        } else {
            y.type = "password";
        }
    }
</script>
</body>
</html>

