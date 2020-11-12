<?php
include_once '../DB/database.php';

if (isset($_POST['register'])) {
    /* Putting the name of the inputs into a array*/
    $fieldnames = ['firstname', 'lastname', 'username', 'email', 'birthdate', 'password', 'rp-password'];

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
         $password = $_POST['password'];
         $rp_password = $_POST['rp-password'];
 
         if ($password === $rp_password) {
            
            /* Making Connection with DB*/
            $person = new DB("localhost", "root", "", "hkspaceblog", "utf8mb4");
 
            /* Getting the values from the form*/
            $firstname = $_POST['firstname'];
            $middlename = $_POST['middlename'];
            $lastname = $_POST['lastname'];
            $username = $_POST['username'];
            $email = $_POST['email'];
            $birthdate = $_POST['birthdate'];
            
 
             /* Putting the values in the function which is located in DB/database.php*/
            $person->person_registration($firstname, $middlename, $lastname, $birthdate, $email, $username, $password);
         }else{
             echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.'Password is not the same!' .'</div>'; 
         }
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
    <title>Register</title>
    <!--Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <!-- CSS Files-->
    <link rel="stylesheet" href="../assets/styles/register/style.css">
</head>
<body>
    <div class="top-right links">
        <a href="../index.php">Welcome</a>
    </div>

    <form action="" method="POST" id="form" autocomplete="off">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Firstname</label>
                    <input type="text" class="form-control" name="firstname" autofocus required/>
                </div>
                <div class="form-group col-md-6">
                    <label>Middlename</label>
                    <input type="text" class="form-control" name="middlename"/>
                </div>
                <div class="form-group col-md-6">
                    <label>Lastname</label>
                    <input type="text" class="form-control" name="lastname" required/>
               </div>
               <div class="form-group col-md-6">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" required/>
               </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" name="email" aria-describedby="emailHelp" required/>
            </div>
            <div class="form-group">
                <label>Birthdate</label>
                <input type="date" class="form-control" name="birthdate" id="example-date-input" required/>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" required/>
                </div>
                <div class="form-group col-md-6">
                    <label>Repeat Password</label>
                    <input type="password" class="form-control" name="rp-password" required/>
                </div>
            </div>
            <div class="form-btm-btn">
                <input type="submit" class="btn btn-primary" name="register" value="Register"/>
                <a href="login.php" class="login-link">Already registered?</a>
            </div>
        </form>
    <?php include "../assets/requires/scripts.php";?>
    <script src="../assets/js/auth/script.js"></script>
</body>
</html>