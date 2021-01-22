<?php
session_start();
$title = "search";
if (isset($_SESSION["email"])) {
    include "init.php";
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {

        if (isset($_POST["serwithselect"])) {
            $min = $_POST["minage"];
            $max = $_POST["maxage"];
            $city = $_POST["city"];
            $soc = $_POST["sociallife"];

            if ((!$min == 0 && !$max == 0) || !$city == 0 || !$soc == 0) {
?>
                <div class="container-fluid">
                    <div class="homepage">
                        <div class="row">
                            <?php include $tmpl . "ads.php"; ?>
                            <?php include $tmpl . "ser.php"; ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <div class="heading">
                                    view users
                                </div>
                                <div class="bodyheading">
                                    <?php
                                    $stmt = $con->prepare("SELECT * FROM users WHERE age >= ? and age <= ? or city = ? or soc = ? ");
                                    $stmt->execute(array($min, $max, $city, $soc));
                                    $allinfo = $stmt->fetchAll();
                                    $path = "../../../../php_mah/social/upload/avatar//";
                                    ?>
                                    <div class="container">
                                        <div class="row">
                                            <?php
                                            foreach ($allinfo as $info) {
                                            ?>
                                                <div class="col-lg-4">
                                                    <div class="carduser">
                                                        <div class="image_card">
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
                                                                <img src="<?php echo $path . $info["img"]; ?>" alt="">
                                                                <?php
                                                            } 
                                                       ?>
                                                        </div>
                                                        <div class="caption_card">
                                                        <h5><?php echo $info["fname"] . " " . $info["lname"]; ?></h5>
                                                        <p class="text-center lead"><?php echo $info["age"]; ?></p>
                                                        </div>
                                                        <button class="btn btn-success"> <i class="fa fa-user-plus"></i> </button>
                                                        <button class="btn btn-danger"> <i class="fa fa-times"></i> </button>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php include $tmpl . "control.php"; ?>
                        </div>
                    </div>
                </div>

            <?php
            }
        } elseif (isset($_POST["serwithname"])) {
            $sername = $_POST["fullname"];
            if (!empty($sername)) {
            ?>
                <div class="container-fluid">
                    <div class="homepage">
                        <div class="row">
                            <?php include $tmpl . "ads.php"; ?>
                            <?php include $tmpl . "ser.php"; ?>
                        </div>
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-6">
                                <div class="heading">
                                    view users
                                </div>
                                <div class="bodyheading">
                                    <?php
                                    $stmt = $con->prepare("SELECT * FROM users WHERE fname like ? or lname like ? ");
                                    $stmt->execute(array('%' . $sername . '%', '%' . $sername . '%'));
                                    $allinfo = $stmt->fetchAll();
                                    ?>
                                    <div class="container">
                                        <div class="row">
                                            <?php
                                            foreach ($allinfo as $info) {
                                            ?>
                                                <div class="col-lg-4">
                                                    <div class="carduser">
                                                        <div class="image_card">
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
                                                                <img src="<?php echo $path . $info["img"]; ?>" alt="">
                                                                <?php
                                                            } 
                                                       ?>
                                                        </div>

                                                        <div class="caption_card">
                                                            <h5><?php echo $info["fname"] . " " . $info["lname"]; ?></h5>
                                                            <p class="text-center lead"><?php echo $info["age"]; ?></p>
                                                        </div>
                                                        <button class="btn btn-success"> <i class="fa fa-user-plus"></i> </button>
                                                        <button class="btn btn-danger"> <i class="fa fa-times"></i> </button>
                                                    </div>
                                                </div>
                                            <?php
                                            }
                                            ?>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <?php include $tmpl . "control.php"; ?>
                        </div>
                    </div>
                </div>
    <?php
            }
        }
    } else {
        header("location:index.php");
    }
    ?>

<?php include $foot;
} else {
    header("location:login.php");
}
