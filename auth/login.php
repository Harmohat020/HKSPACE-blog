<?php
include_once '../DB/database.php';

if (isset($_POST['login'])) {
    /* Putting the name of the inputs into a array*/
    $fieldnames = ['username', 'password'];

    $error = false;
    
    /* Looping the fieldnames in the $_POST[], if a fieldname is empty $error will be set to true*/
    foreach ($fieldnames as $data) {
        if(empty($_POST[$data])){
            $error = true;
        }    
    }

    /* If $error true error message will be shown*/
    if (!$error) {
        /* Getting the password values from the form*/
        $username = $_POST['username'];
        $password = $_POST['password'];
  
         /* Making Connection with DB*/
        $person = new DB("localhost", "root", "", "hkspaceblog", "utf8mb4");
           
        /* Putting the values in the function which is located in DB/database.php*/
        $person->login($username, $password);
   }else{
       echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.'All fields are required!' .'</div>'; 
   }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- CSS Files-->
    <link rel="stylesheet" href="../assets/styles/login/style.css">
</head>
<body>
    <div class="top-right links">
        <a href="../index.php">Welcome</a>
    </div>
    
    <form action="" method="POST" id="form" autocomplete="off">
        <div class="form-group">
            <label>Username</label>
            <input type="text" name="username" class="form-control" autofocus required/>
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required/>
        </div>
        <div class="form-btm-btn">
            <input type="submit" name="login" class="btn btn-primary" value="Login"/>
            <a href="register.php" class="register-link">No account?</a>
        </div>
    </form>

    <?php include "../assets/requires/scripts.php";?>
    <script src="../assets/js/auth/script.js"></script>
</body>
</html>
