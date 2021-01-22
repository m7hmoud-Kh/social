<div class="col-lg-6">
    <div class="heading">
        view users
    </div>
    <div class="bodyheading">
        <?php
        if (isset($_GET["page"])) {
            $page = $_GET["page"];
        } else {
            $page = 1;
        }
        $user_per_page = 3;
        $form = ($page - 1) * $user_per_page; // index that start with user by default 0 
        $stmt = $con->prepare("SELECT * FROM users WHERE ID != ? LIMIT $form,$user_per_page");
        $stmt->execute(array($_SESSION["uid"]));
        $allinfo = $stmt->fetchAll();
        ?>
        <div class="container">
            <div class="row">
                <?php
                foreach ($allinfo as $info) {
                ?>
                    <div class="col-lg-4">
                        <div class="carduser">
                            <a href="profile.php?do=<?php echo $info["ID"] ?>">
                                <div class="image_card contolimg">
                                    <?php
                                    if ($info["img"] == 0) {
                                    ?>
                                        <img src="../../../../php_mah/social/include/template/layout/img/imagedefalut.png" alt="">
                                    <?php
                                    } else {
                                    ?>
                                        <img src="<?php echo $path . $info["img"]; ?>" alt="">
                                    <?php
                                    }
                                    ?>
                                </div>
                            </a>
                            <div class="caption_card">
                                <h5 class="text-center"><?php echo $info["fname"] . " " . $info["lname"]; ?></h5>
                                <p class="lead text-center"><?php if ($info["city"] == 1) {
                                                                echo "Cairo";
                                                            } elseif ($info["city"] == 2) {
                                                                echo "Alexandria";
                                                            } elseif ($info["city"] == 3) {
                                                                echo "Giza";
                                                            } elseif ($info["city"] == 4) {
                                                                echo "Menoufia";
                                                            } elseif ($info["city"] == 5) {
                                                                echo "Assuit";
                                                            } elseif ($info["city"] == 6) {
                                                                echo "Qena";
                                                            } elseif ($info["city"] == 7) {
                                                                echo "Sohag";
                                                            } elseif ($info["city"] == 8) {
                                                                echo "Aswan";
                                                            } ?></p>
                                <p class="lead text-center"><?php echo $info["age"] . " Years"; ?></p>
                                <button class="btn btn-success"> <i class="fa fa-user-plus"></i> </button>
                                <button class="btn btn-danger"> <i class="fa fa-times"></i> </button>
                                <a href="chat.php?friend=<?php echo $info["ID"]; ?>">
                                    <button class="btn btn-info"> <i class="fa fa-comments"></i> </button>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
            <div class="text-center">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php
                            $stmt = $con->prepare("SELECT ID FROM users WHERE ID != ?");
                            $stmt->execute(array($_SESSION["uid"]));
                            $totaluser = $stmt->rowCount();
                            $totalpage = ceil($totaluser/$user_per_page);
                            ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php if(($page - 1) > 0){echo $page - 1 ; }elseif(($page-1) == 0){echo 1;} ?>">Previous</a></li>
                            <?php
                            for ($i = 1; $i <= $totalpage; $i++) {
                            ?>
                                <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                            <?php
                            }
                            ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?php if(($page+1) <= $totalpage){echo $page+1 ; } elseif(($page+1) >= $totalpage ){echo $totalpage;} ?>">Next</a></li>
                        </ul>
                    </nav>
            </div>
        </div>
    </div>
</div>