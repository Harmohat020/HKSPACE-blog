<?php

include_once '../../DB/database.php';

session_start();
                    
$user = $_SESSION['row'];

if (!isset($_SESSION['username']) OR $user['type_id'] != 2) {
    header("Location: ../../auth/login.php");
    exit;
}else{
    $db = new DB("localhost", "root", "", "hkspaceblog", "utf8mb4");

    $posts = $db->show_todays_posts();

    $comments = $db->show_comments();

    if (isset($_POST['form-comment'])) {
        if (empty($_POST['input-comment'])) {
            $form_err = '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.'All fields are required!' .'</div>'; 
        }
        else{
            $comment = $db->insert_comment($_POST['input-comment'], $_POST['form_post_id'], $user['ID']);
        }
    }

}
?>
<main role="main" class="container">
    <div class="row db-title">
        <h2>Today's Posts</h2><small><?php echo  date("Y/m/d");?></small>
    </div> 
    <hr>
    <?php
    if (array_key_exists('error', $posts)):
        echo $posts['error'];
    else:
        foreach ($posts as $post): 
            $date = (explode(" ",$post['created_at'])); 
                if($date[0] === date("Y-m-d")):  
    ?>
    <div class="card">
        <div class="card-body">
            <h5><?php echo $post['title'];?></h5>
            <p><?php echo $post['content'];?></p>
            <small class="text-muted"><?php echo $date[1]; ?> By: <?php echo $post['username'];?></small>
            <br><br>
            <button class="open button btn btn-info pull-right" id="comment-btn">Show Comments</button>
            <hr>
            <div class="comments row bootstrap snippets bootdeys" id="comments">
                <div class="col-md-8 col-sm-12">
                    <div class="comment-wrapper">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <?php 
                                if (isset($form_err)) {
                                    echo $form_err;                                      
                                }
                                ?>
                            </div>
                            <div class="panel-body">
                                <form action="" method="post">
                                    <textarea class="form-control" id="mytextarea" name="input-comment" placeholder="write a comment..." rows="3" required></textarea>
                                    <input type="hidden" name="form_post_id" value="<?php echo  $post['id'];?>">
                                    <br>
                                    <input type="submit" name="form-comment" class="btn btn-info pull-right" value="Post">
                                </form>
                                <div class="clearfix"></div>
                                <hr>
                                <?php
                                if (array_key_exists('error', $comments)):
                                    echo $comments['error'];
                                else:
                                    for ($i=0; $i < count($comments); $i++):  
                                        if ($comments[$i]['post_id'] == $post['id']):
                                ?>
                                <ul class="media-list">
                                    <li class="media">
                                        <a href="#" class="pull-left">
                                            <img src="<?php echo $comments[$i]['profile_photo']; ?>" alt="" class="img-circle">
                                        </a>
                                        <div class="media-body">
                                            <span class="text-muted pull-right">
                                                <small class="text-muted"><?php echo $comments[$i]['created_at']; ?></small>
                                            </span>
                                            <strong class="text-success"><?php echo $comments[$i]['username']; ?></strong>
                                            <p>
                                                <?php echo $comments[$i]['comment']; ?>
                                            </p>
                                        </div>
                                    </li>
                                </ul>
                            <?php endif;?>
                            <?php endfor;?>
                            <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif;?>
    <?php endforeach;?> 
    <?php endif;?>
    <br>
</main>

<script>
    $('#comment-btn').click('slow', () => {
        var link = $(this);
        $('.comments').slideToggle( () => {
            if ($(this).is(":visible")) {
                link.text('Hide Comments'); 
                link.css('background-color','red'); 
            } else {
                link.text('Show Comments'); 
                link.css('background-color','#17a2b8'); 
            }        
        });        
    }); 
    
    if($('.container').is(':visible')){
        $('.loader').css('display','none');
    }else{
        $('.loader').css('display','block');
    }
</script>
