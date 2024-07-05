<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje financije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
    <div class="topnav" id="myTopnav">
        <a href="<?php echo __SITE_URL . '/index.php?rt=home'; ?>" class="active">Home</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=exspenses'; ?>">Exspenses</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=categories'; ?>">Categories</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=savings'; ?>">Savings</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=report'; ?>">Report</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=logout'; ?>">Log out</a>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fa fa-bars"></i>
        </a>
    </div>
    
    <script>
    function myFunction() {
        var x = document.getElementById("myTopnav");
        if (x.className === "topnav") {
            x.className += " responsive";
        } else {
            x.className = "topnav";
        }
    }
    </script>
</body>
</html>