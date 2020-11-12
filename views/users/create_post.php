<?php
include_once '../../DB/database.php';

session_start();
                  
$user = $_SESSION['row'];

if (!isset($_SESSION['username']) OR $user['type_id'] != 2) {
    header("Location: ../../auth/login.php");
    exit;
}else{
    if (isset($_POST['create'])) {
        $fieldnames = ['title', 'summary', 'content'];

        $error = false;
    
        /* Looping the fieldnames in the $_POST[], if a fieldname is empty $error will be set to true*/
        foreach ($fieldnames as $data) {
            if(empty($_POST[$data])){
                $error = true;
            }    
        }

        if (!$error) {
            $post = new DB("localhost", "root", "", "hkspaceblog", "utf8mb4");

            $title = $_POST['title'];
            $summary = $_POST['summary'];
            $content = $_POST['content'];

            $post->create_post($title, $summary, $content, $_GET['id']);
        }else{
            echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.'All fields are required!' .'</div>'; 
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post - <?php echo $user['username']; ?></title>
    <!--Tab Img-->
    <link rel="icon" href="../../assets/img/logo/logo.png" type="image" sizes="16x16">
    
    <!--Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!--Nav CSS -->
    <link rel="stylesheet" href="../../assets/styles/nav/style.css">

    <!--CSS-->
    <link rel="stylesheet" href="../../assets/styles/users/style.css">

</head>
<body>
<?php include "../../assets/requires/nav.php";?>
    <main role="main" class="container">
        <h2>Create Post</h2>
        <hr>
        <form action="" method="POST" autocomplete="off" class="create-form">
            <div class="form-group">
                <label>Title</label>
                <input type="text" name="title" class="create-title form-control" minlength="5" maxlength="100" required autofocus/>
            </div>
            <div class="form-group">
                <label>Summary</label>
                <textarea name="summary" class="create-summary form-control" minlength="8" rows="2" required></textarea>
            </div>
            <div class="form-group">
                <label>Content</label>
                <textarea name="content" class="create-content form-control" minlength="8" rows="4" required></textarea>
            </div>
            <br>
            <hr>
            <center>
                <input type="submit" value="create" name="create" class="create-submit btn btn-secondary"/>
            </center>
        </form>
        <form action="overview.php?page=overview.php" method="post">
            <input type="hidden" name="id" value="<?php echo $user['ID']; ?>">
            <input type="submit" class="btn btn-info mb-3" value="Go Back"/>
        </form>
    </main>
<?php include "../../assets/requires/scripts.php";?>
<script src="../../assets/js/nav/script.js"></script>
</body>
</html>