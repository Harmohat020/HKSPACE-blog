<?php
include_once '../../DB/database.php';

session_start();
                    
$user = $_SESSION['row'];

if (!isset($_SESSION['username']) OR $user['type_id'] != 2) {
    header("Location: ../../auth/login.php");
    exit;
}else{
    $posts = new DB("localhost", "root", "", "hkspaceblog", "utf8mb4");
    $posts->show_todays_posts();

    $comments = new DB("localhost", "root", "", "hkspaceblog", "utf8mb4");
    $comments->show_comments();

    if (isset($_POST['form-comment'])) {
        if (empty($_POST['input-comment'])) {
            $form_err = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.'All fields are required!' .'</div>'; 
        }
        else{
            $comment = new DB("localhost", "root", "", "hkspaceblog", "utf8mb4");
            $comment->insert_comment($_POST['input-comment'], $_POST['form_post_id'], $user['ID']);
        }
    }

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
    <main role="main" class="container">
        <div class="row db-title">
            <h2>Today's Posts</h2><small><?php echo  date("Y/m/d");?></small>
        </div>
        <hr>
        <?php 

        foreach ($posts->rows as $post): 
             $date = (explode(" ",$post['created_at'])); 
                if($date[0] === date("Y-m-d")):          
        ?>
            <div class="card">
                <div class="card-body">
                    <h5><?php echo $post['title'];?></h5>
                    <p><?php echo $post['content'];?></p>
                    <small class="text-muted"><?php echo $date[1]; ?> By: <?php echo $post['username'];?></small>
                <br><br>
                    <button class="button btn btn-info pull-right" id="comment-btn">comments</button>
                <hr>
                    <div class="comments row bootstrap snippets bootdeys" id="comments">
                        <div class="col-md-8 col-sm-12">
                            <div class="comment-wrapper">
                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        <?php echo $form_err;?>
                                    </div>
                                    <div class="panel-body">
                                        <form action="" method="post">
                                            <textarea class="form-control" name="input-comment" placeholder="write a comment..." rows="3" required></textarea>
                                            <input type="hidden" name="form_post_id" value="<?php echo $post['id'];?>">
                                            <br>
                                            <input type="submit" name="form-comment" class="btn btn-info pull-right" value="Post">
                                        </form>
                                        <div class="clearfix"></div>
                                        <hr>
                                        <?php 
                                            for ($i=0; $i < count($comments->comments); $i++):
                                                if ($comments->comments[$i]['post_id'] == $post['id']):         
                                        ?>
                                        <ul class="media-list">
                                            <li class="media">
                                                <a href="#" class="pull-left">
                                                    <img src="<?php echo $comments->comments[$i]['profile_photo']; ?>" alt="" class="img-circle">
                                                </a>
                                                <div class="media-body">
                                                    <span class="text-muted pull-right">
                                                        <small class="text-muted"><?php echo $comments->comments[$i]['created_at']; ?></small>
                                                    </span>
                                                    <strong class="text-success"><?php echo $comments->comments[$i]['username']; ?></strong>
                                                    <p>
                                                        <?php echo $comments->comments[$i]['comment']; ?>
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                       <?php endif;?>
                                      <?php endfor;?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
          <?php endif;?>
        <?php endforeach;?>
        <div id="prices"></div>
    </main>
    <?php include "../../assets/requires/scripts.php";?>
    <script src="../../assets/js/nav/script.js"></script>
    <script>
    $(function () {
        $('.button').click(function () {
            $(this).siblings('.comments').toggle('slow');
        })
    })
    //slideToggle('slow')
    </script>
</body>
</html>