<?php
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
    <title>Show - <?php echo $user['username']; ?></title>
    <!--Tab Img-->
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image" sizes="16x16">
    
    <!--Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <!--CSS-->
    <link rel="stylesheet" href="../../assets/styles/users/style.css">

    <!--Nav CSS -->
    <link rel="stylesheet" href="../../assets/styles/nav/style.css">
</head>
<body>
    <?php include "../../assets/requires/nav.php";?>

    <main role="main" class="container"> 
        <div class="card">
            <div class="container">
            <img src="<?php echo $user['profile_photo'];?>" class="user-photo">

                <p><b>Firstname: </b><?php echo $user['firstname'];?></p> 
                <p><b>Middlename: </b>
                <?php 
                 if (empty($user['middlename'])) {
                     echo 'n/a';
                 }else{
                     echo $user['middlename'];
                 }
                 ?>
                </p> 
                <p><b>Lastname: </b><?php echo $user['lastname'];?></p> 
                <p><b>Birthdate: </b><?php echo $user['birthdate'];?></p> 
                <p><b>Email: </b><?php echo $user['email'];?></p> 
                <p><b>Username: </b><?php echo $user['username'];?></p> 
                <p><b>Member since: </b><?php echo $user['created_at'];?></p> 
            </div>
        </div>
    </main>


    <?php include "../../assets/requires/scripts.php";?>
    <script src="../../assets/js/nav/script.js"></script>
</body>
</html>