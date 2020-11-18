<?php
include_once '../../DB/database.php';

session_start();
                    
$user = $_SESSION['row'];

if (!isset($_SESSION['username']) OR $user['type_id'] != 2) {
    header("Location: ../../auth/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - <?php echo $user['username']; ?></title>
    <!--Tab Img-->
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image" sizes="16x16">

    <!--Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!--Nav CSS -->
    <link rel="stylesheet" href="../../assets/styles/nav/style.css">

    <!--CSS-->
    <link rel="stylesheet" href="../../assets/styles/users/dashboard/style.css">
</head>
<body>
    <?php include "../../assets/requires/nav.php";?>
    <center>
        <div class="loader">
            <div></div>
            <div></div>
        </div>    
    </center>

    <div id="result"></div>

     
    <?php include "../../assets/requires/scripts.php";?>
    <script src="../../assets/js/nav/script.js"></script>
    <script>
    var load_page = () => {
        $("#result" ).load( "../../assets/requires/dashboard.php")
    };

    var id = setInterval(load_page, 1000);

    $("#comment-btn").click(function(){
        $(this).data('clicked', true);
    });
    
    if($("#comment-btn").data('clicked')){
        console.log('Button is clicked');
    }else{
        console.log('Button is unclicked');
    }
    </script>
</body>
</html>