<?php
require_once('src/autoload.php');
try{
    $count = 1;
    $faker = Faker\Factory::create('en_GB');;
    //Connecting MySQL Database
    $pdo  = new PDO('mysql:host=localhost;dbname=hkspaceblog', 'root', '', array(
        PDO::ATTR_PERSISTENT => true
    ));
    $pdo->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
     
    $pwd = password_hash('admin123', PASSWORD_DEFAULT);  
    //Insert the data
    $sql = "INSERT INTO users(ID, firstname, middlename, lastname, birthdate, email, username, profile_photo, password, type_id)
            VALUES(NULL, :firstname, :middlename, :lastname, :birthdate, :email, :username, :profile_photo, :password, :type_id);";

    $stmt = $pdo->prepare($sql);

    for ($i=0; $i < $count; $i++) {
        $stmt->execute(
            [   
                'firstname' => 'Harmohat',
                'middlename' => '',
                'lastname' => 'Khangura',
                'birthdate' => '2002-05-22',
                'email' => '2101819@talnet.nl',
                'username' => 'harmohat@admin',
                'profile_photo' => "https://ui-avatars.com/api/?name={harmohat@admin}&7F9CF5&background=EBF4FF",
                'password' => $pwd,
                'type_id' => 1
            ]
        );
    }

    /* Getting the last inserted ID value */
    // $ID = $pdo->lastInsertId();

    // echo $ID;
                
    // $sql2 = "INSERT INTO administrator(ID, voornaam, tussenvoegsel, achternaam, account_id)
    // VALUES(NULL, :voornaam, :tussenvoegsel, :achternaam, :id);";
         
    // $stmt = $pdo->prepare($sql2);

    // for ($i=0; $i < $count; $i++) {
    //     $stmt->execute(
    //         [
    //             ':voornaam' => 'Harmohat', 
    //             ':tussenvoegsel' => '',  
    //             ':achternaam' => 'Khangura',
    //             'id' => $ID  
                
    //         ]
    //     );
    // }
} 
catch(Exception $e){
    echo '<pre>';print($e);echo '</pre>';exit;
}
?>
