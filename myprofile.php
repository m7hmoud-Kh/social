<?php
session_start();
$title = "My Profile";
if (isset($_SESSION["email"])) {
    if (isset($_GET["do"]) && is_numeric($_GET["do"])) {
        include "init.php";
        $uid = filter_var($_GET["do"], FILTER_SANITIZE_NUMBER_INT);
        if ($uid == $_SESSION["uid"]) {
            $stmt = $con->prepare("SELECT * FROM users WHERE ID = ?");
            $stmt->execute(array($uid));
            $info = $stmt->fetch();
            $path = "../../../../php_mah/social/upload/avatar//";
?>
            <div class="homepage">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="heading">
                                posts
                            </div>
                            <div class="bodyheading">

                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="heading">
                                personal picture
                            </div>
                            <div class="bodyheading">
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
                                <a href="upload_pic.php" class="photochange">Change Photo</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <div class="heading">
                                Photo Gallery
                            </div>
                            <div class="bodyheading">
                                rrrrrrr
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-9"></div>
                        <div class="col-lg-3">
                            <div class="heading">
                                personal information
                            </div>
                            <div class="bodyheading">
                                <ul class="list-unstyled  moreinfo">
                                    <li><span>Age</span>: <?php echo $info["age"]; ?></li>
                                    <li><span>City</span>:
                                        <?php if ($info["city"] == 1) {
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
                                        } ?></li>
                                    <li><span>Social status</span>: <?php if ($info["soc"] == 1) {
                                                                        echo "Single";
                                                                    } elseif ($info["soc"] == 2) {
                                                                        echo "Married";
                                                                    } elseif ($info["soc"] == 3) {
                                                                        echo "widow";
                                                                    } ?></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<?php

        } else {
            header("location:index.php");
        }
    }
    include $foot;
} else {
    header("location:login.php");
}
