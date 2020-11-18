<?php
class DB{
    private $host;
    private $user;
    private $pass;
    private $db;
    private $charset;
    private $pdo;
    private $comments;

    public function __construct($host, $user, $pass, $db, $charset){
        $this->host = $host;
        $this->user = $user;
        $this->pass = $pass;
        $this->db = $db;
        $this->charset = $charset; 
        
        try{
            $dsn = 'mysql:host='. $this->host.';dbname='.$this->db.';charset='.$this->charset;
            $this->pdo = new PDO($dsn, $this->user, $this->pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->pdo;
        }
        catch(\PDOException $e){
            echo "Connection Failed: ".$e->getMessage();
        }
      
    }

    public function err_msg_auth($msg){   
        return '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$msg.'</div>';    
    }

    public function person_registration($firstname, $middlename, $lastname, $birthdate, $email, $username, $password){
        try {
            $sqlCheck = "SELECT email, username FROM users;";

            $queryCheck = $this->pdo->prepare($sqlCheck);

            $queryCheck->execute();

            $rows = $queryCheck->fetchAll(PDO::FETCH_ASSOC);

            if (in_array($email, $rows[0]) AND in_array($username, $rows[0])) {
                echo $this->err_msg_auth('This <b>username</b> and <b>email</b> already exists');
            }elseif (in_array($username, $rows[0])) {
                echo $this->err_msg_auth('This <b>username</b> already exists');
            }elseif (in_array($email, $rows[0])) {
                echo $this->err_msg_auth('This <b>email</b> already exists');
            }else{
                /* Begin a transaction, turning off autocommit */
                $this->pdo->beginTransaction();
                
                $pwdHash = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users(ID, firstname, middlename, lastname, birthdate, email, username, profile_photo, password, type_id)
                        VALUES(NULL, :firstname, :middlename, :lastname, :birthdate, :email, :username, :profile_photo, :password, :type_id);";
                
                $query = $this->pdo->prepare($sql);

                $query->execute([
                    'firstname' => $firstname,
                    'middlename' => $middlename,
                    'lastname' => $lastname,
                    'birthdate' => $birthdate,
                    'email' => $email,
                    'username' => $username,
                    'profile_photo' => "https://ui-avatars.com/api/?name={$username}&7F9CF5&background=EBF4FF",
                    'password' => $pwdHash,
                    'type_id' => 2
                ]);

                /* Commit the changes */
                $this->pdo->commit();

                /* Prevents that data is always added to the table during refresh */
                header("Location: login.php");
                exit;

            }

        } 
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }
  
    public function login($username, $password){
        try {
            $sql = "SELECT * FROM users WHERE username = :username;";

            $query = $this->pdo->prepare($sql);

            $query->execute([
                'username' => $username
            ]);

            $row = $query->fetch(PDO::FETCH_ASSOC);
            // print '<pre>'.print_r($row, true).'</pre>';
            if ($row > 0) {
                $verify = password_verify($password, $row['password']);

                if ($verify) {
                    session_start();
                    
                    $_SESSION['row'] = $row;
                    $_SESSION['username'] = $row['username'];
                    
                    header("Location: ../views/users/");
                    exit;

                }else {
                    echo $this->err_msg_auth('Invalid <b>username</b> or <b>password</b>');
                }
            }else {
                echo $this->err_msg_auth('Invalid <b>username</b> or <b>password</b>');
            }
        }   
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }

    public function create_post($title, $summary, $content, $id){
        try {
            /* Begin a transaction, turning off autocommit */
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO posts(ID, title, summary, content, author_id)
                    VALUES(NULL, :title, :summary, :content, :author_id);";

            $query = $this->pdo->prepare($sql);

            $query->execute([
                'title' => $title,
                'summary' => $summary,
                'content' => $content,
                'author_id' => $id
            ]);

            /* Commit the changes */
            $this->pdo->commit();

            /* Prevents that data is always added to the table during refresh */
            header("Location: create_post.php");
            exit;
        }
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }
   
    public function show_user_post($id){
        try {
            $sql = "SELECT posts.id, title, summary, content, author_id FROM posts 
                    INNER JOIN users ON posts.author_id = users.id WHERE users.id = :id;";

            $query = $this->pdo->prepare($sql);

            $query->execute([
                'id' => $id
            ]);

            /*Fetching rows */
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($rows) > 0) {
                $this->array = [];
                array_push($this->array, $rows);
            }
        }  
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }
   
    public function show_post_detail($id){
        try {
            $sql ="SELECT * FROM posts WHERE id = :id;";

            $query = $this->pdo->prepare($sql);

            $query->execute([
                'id' => $id
            ]);

            /*Fetching rows */
            $this->rows = $query->fetchAll(PDO::FETCH_ASSOC);
        }
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }
  
    public function edit_post($title, $summary, $content, $id){
        try {
            /* Begin a transaction, turning off autocommit */
            $this->pdo->beginTransaction();

            $sql = "UPDATE posts SET title = :title, summary = :summary, content = :content WHERE id = :id;";

            $query = $this->pdo->prepare($sql);

            $query->execute([
                'title' => $title,
                'summary' => $summary,
                'content' => $content,
                'id' => $id
            ]);

            /* Commit the changes */
            $this->pdo->commit();

            /* Prevents that data is always added to the table during refresh */
            header("Location: edit.php");
            exit;
        }   
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }

    public function delete_post($id){
        try {
            /* Begin a transaction, turning off autocommit */
            $this->pdo->beginTransaction();
            
            $sql2  = "DELETE FROM comments WHERE post_id = :id";

            $query2 = $this->pdo->prepare($sql2);

            $query2->execute([
                'id' => $id
            ]);
            
            $sql = "DELETE FROM posts WHERE id = :id;";

            $query = $this->pdo->prepare($sql);

            $query->execute([
                'id' => $id
            ]);

            /* Commit the changes */
            $this->pdo->commit();

            header("Refresh:0");

        }
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }

    public function show_todays_posts(){
        try {
            $sql = "SELECT posts.id, title, summary, content, posts.created_at, username FROM posts
                    INNER JOIN users where author_id = users.id;";

            $query = $this->pdo->prepare($sql);

            $query->execute();

            /*Fetching rows */
            $rows = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($rows) > 0) {
               return $this->rows = $rows;
            }else{
               return $this->rows =  ['error' => $this->err_msg_auth('No <b>Data</b> available')];
            }

        } 
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }

    public function show_comments(){
        try {
            $sql = "SELECT comment, comments.created_at AS created_at, username, profile_photo, post_id 
                    FROM comments INNER JOIN users ON user_id = users.id;";

            $query = $this->pdo->prepare($sql);

            $query->execute();

            /*Fetching rows */
            $comments = $query->fetchAll(PDO::FETCH_ASSOC);

            if (count($comments) > 0) {
                return $this->comments = $comments;
            }else{
                return $this->comments =  ['error' => $this->err_msg_auth('No <b>comments</b> available')];
             }
            

        }       
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }

    public function insert_comment($comment, $post_id, $user_id){
        try {
            $this->pdo->beginTransaction();

            $sql = "INSERT INTO comments(ID, comment, post_id, user_id)
                    VALUES(NULL, :comment, :post_id, :user_id);";
            
            $query = $this->pdo->prepare($sql);

            $query->execute([
                'comment' => $comment,
                'post_id' => $post_id,
                'user_id' => $user_id
            ]);

            $this->pdo->commit();

            header("Refresh:0");
            exit;
        } 
        catch (PDOException $e) {
            /* Recognize mistake and roll back changes */
            $this->pdo->rollback();
            
            throw $e;
        }
    }
}
?>