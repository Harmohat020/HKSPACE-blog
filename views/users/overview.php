<?php
include_once '../../DB/database.php';

session_start();
                    
$user = $_SESSION['row'];

if (!isset($_SESSION['username']) OR $user['type_id'] != 2) {
    header("Location: ../../auth/login.php");
    exit;
}else{
    $overview = new DB("localhost", "root", "", "hkspaceblog", "utf8mb4");
    $overview->show_user_post($user['ID']);

    if(isset($_POST['delete'])){
        $overview->delete_post($_POST['post_id']);

    }
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

    <!--Datatable CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!--Nav CSS -->
    <link rel="stylesheet" href="../../assets/styles/nav/style.css">
   
    <!--CSS-->
    <link rel="stylesheet" href="../../assets/styles/users/style.css">
</head>
<body class="overview-body">
<?php include "../../assets/requires/nav.php";?>
    <main role="main" class="container">
        <div class="pull-right">
            <a class="btn btn-success mb-3" href="create_post.php?id=<?php echo $user['ID']; ?>">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>Post</a>
        </div>
        <table class="table table-striped" id="overview">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Summary</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (empty($overview->array)):
                        echo '<div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.'No data available' .'</div>';    
                    else:
                        foreach ($overview->array as $array): 
                            foreach ($array as $post): ?>
                    <tr>
                        <td><?php echo $post['id']; ?></td>
                        <td><?php 
                        if (strlen($post['title']) > 40) {
                            echo substr($post['title'], 0, -50).'...';
                        }else{
                            echo $post['title'];
                        }
                        
                        ?></td>
                        <td><?php 
                        if (strlen($post['summary']) > 80) {
                            echo substr($post['summary'], 0, -180).'...';
                        }elseif (strlen($post['summary']) > 40) {
                            echo substr($post['summary'], 0, -50).'...';
                        }
                        else{
                            echo $post['summary'];
                        }
                        
                        ?></td>
                        <td class="noExl">
                            <div class="row">
                                <form action="show_post.php" method="post">
                                    <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                    <input type="submit" class="btn btn-secondary mr-2 btn-sm" value="Show"/>
                                </form>
                                <form action="edit.php" method="post">
                                        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                                    <input type="submit" class="btn btn-primary mr-2 btn-sm" value="Edit">
                                </form>
                                <form action="" method="post">
                                    <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                                    <input type="submit" name="delete" class="btn btn-danger mr-2 btn-sm" value="Delete">
                                </form>
                           </div>
                        </td> 
                    </tr> 
                     <?php    endforeach; ?>
                    <?php   endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
    </main>
    <?php include "../../assets/requires/scripts.php";?>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../assets/js/nav/script.js"></script>
    <script src="../../assets/js/datatable/script.js"></script>
 
</body>
</html>