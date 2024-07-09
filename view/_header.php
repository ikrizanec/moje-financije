<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moje financije</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL . '/style/style.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL . '/style/categories.css';?>">
    <link rel="stylesheet" type="text/css" href="<?php echo __SITE_URL . '/style/savings.css';?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="topnav" id="myTopnav">
        <a href="<?php echo __SITE_URL . '/index.php?rt=users/home'; ?>" class="active" id="home">Home</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=transactions'; ?>" id="transactions">Transactions</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=categories'; ?>" id="categories">Categories</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=savings'; ?>" id="savings">Savings</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=reports'; ?>" id="report">Report</a>
        <a href="<?php echo __SITE_URL . '/index.php?rt=users/logout'; ?>" id="logout">Log out</a>
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

    $(document).ready(function(){
        var activeLink = localStorage.getItem('activeLink');
        if (activeLink) {
            $(".topnav a").removeClass("active");
            $("#" + activeLink).addClass("active");
        }

        $(".topnav a").on("click", function() {
            $(".topnav a").removeClass("active");
            $(this).addClass("active");

            var id = $(this).attr('id');
            localStorage.setItem('activeLink', id);
        });
    });
    </script>
</body>
</html>
