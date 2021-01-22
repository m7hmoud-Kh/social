<nav class="navsoc  navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand brandface" href="#">Facebook</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="stat nav-link" href="index.php"> <i class="fa fa-home"></i> Home</a>
      </li>
      <li class="nav-item">
        <a class="stat nav-link" href="#"> <i class="fa fa-comments"></i> Messages</a>
      </li>
      <li class="nav-item dropdown userlist">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <?php
           $stmt = $con->prepare("SELECT * FROM users WHERE ID = ?");
           $stmt->execute(array($_SESSION["uid"]));
           $info = $stmt->fetch();
              echo ucfirst ($info["fname"]) . " " . ucfirst($info["lname"]);
              $path = "../../../../php_mah/social/upload/avatar//";
          ?>
          <span>
            <?php 
            if($info["img"] == 0)
            {
              ?>
              <img src="../../../../php_mah/social/include/template/layout/img/imagedefalut.png" alt="">
              <?php
            }
            else
            {
              ?>
              <img src="<?php echo $path.$info["img"]; ?>" alt="">
              <?php 
            }
            ?>
          </span>
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="edit.php"><i class="fa fa-edit"></i> Edit</a>
          <a class="dropdown-item" href="myprofile.php?do=<?php echo $info["ID"]; ?>">
          <i class="fa fa-user"></i> profile</a>
          <a class="dropdown-item" href="post.php"> <i class="fa fa-plus"></i> Add post </a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="logout.php"> 
            <i class="fas fa-sign-in-alt"></i> logout</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="search.php" method= 'post'>
      <input class="form-control mr-sm-2" name="fullname" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0 btn btn-success ser" type="submit" name="serwithname"> 
        <i class="fa fa-search"></i> Search</button>
    </form>
  </div>
</nav>