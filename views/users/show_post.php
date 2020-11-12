<?php
include_once '../../DB/database.php';

session_start();
                    
$user = $_SESSION['row'];

if (!isset($_SESSION['username']) OR $user['type_id'] != 2) {
    header("Location: ../../auth/login.php");
    exit;
}else{
    $detail = new DB("localhost", "root", "", "hkspaceblog", "utf8mb4");

    $detail->show_post_detail($_POST['id']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts - <?php echo $user['username']; ?></title>
    <!--Tab Img-->
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image" sizes="16x16">
    
    <!--Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!--Nav CSS -->
    <link rel="stylesheet" href="../../assets/styles/nav/style.css">

    <!--CSS-->
    <link rel="stylesheet" href="../../assets/styles/users/style.css">

</head>
<body class="show_post-body">
<?php include "../../assets/requires/nav.php";?>
    <main role="main" class="container">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title"><?php print $detail->rows[0]['title'];?></h5>
            </div>
            <div class="card-body">
                <h6 class="card-title"><?php print $detail->rows[0]['summary'];?></h6>
                <p class="card-text"><?php print $detail->rows[0]['content'];?></p>
                <small><p>Date Created: <?php print $detail->rows[0]['created_at'];?></p></small>
                <form action="overview.php?page=overview.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $user['ID']; ?>">
                    <input type="submit" class="btn btn-info mb-3" value="Go Back"/>
                </form>
            </div>
        </div>
    </main>
<?php include "../../assets/requires/scripts.php";?>
<script src="../../assets/js/nav/script.js"></script>
</body>
</html>