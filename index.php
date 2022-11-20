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
        <div class="chat-box">
            <ul>
                <li>Player1: Hi</li>
                <li>Player58: Hello guys</li>
                <li>XPlayesX: Someone looking for money?</li>
                <li>Mark: Welcome here</li>
                <li>Michael: Michael HERE!</li>
            </ul>
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
