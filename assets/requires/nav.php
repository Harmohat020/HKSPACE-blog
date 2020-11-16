  <?php                    
  $user = $_SESSION['row'];
  ?>
  

  <!-- Navigation -->
  <nav class="nav-custom">
      <div class="logo">
        <ul class="logo-link"><li <?php if(isset($_GET['page'])){ if($_GET['page']=="index.php")   { echo " class=\"active\""; } }?>><a href="index.php?page=index.php"><img src="../../assets/img/logo/logo.png" height="50" width="50"></a></li></ul>
      </div>
      <ul class="nav-links">
          <li <?php if(isset($_GET['page'])){ if($_GET['page']=="index.php")   { echo " class=\"active\""; } }?>><a href="index.php?page=index.php">Home</a></li>
          <li <?php if(isset($_GET['page'])){ if($_GET['page']=="overview.php")   { echo " class=\"active\""; } }?>>
            <form action="overview.php?page=overview.php" method="post" class="id-form">
              <input type="hidden" name="id" value="<?php echo $user['ID']?>">
              <input type="submit" value="Posts"/>
            </form>  
          </li>
      </ul>
      <div class="dropdown">
        <button class="dropbtn"> 
          <img src="<?php echo $user['profile_photo'];?>" class="menu_photo" alt="">
        </button>
        <div class="dropdown-content">
            <ul class="dropdown-links-cstm">
                <li <?php if(isset($_GET['page'])){ if($_GET['page']=="show.php")   { echo " class=\"active\""; } }?>><a href="show.php?page=show.php">Profile</a></li>
                <li><a href="../../auth/logout.php">Logout</a></li>
            </ul>
        </div>
      </div> 
      <div class="small-device">
        <div class="line-1"></div>
        <div class="line-2"></div>
        <div class="line-3"></div>
      </div>
    </nav>
 