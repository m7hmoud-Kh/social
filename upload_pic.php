<?php
session_start();
ob_start();
$title = "change photo";
if (isset($_SESSION["email"])) {
    include "init.php";
    $stmt = $con->prepare("SELECT img FROM users WHERE ID = ?");
    $stmt->execute(array($_SESSION["uid"]));
    $pic = $stmt->fetch();
    $count = $stmt->rowCount();
    if (!$pic["img"] == 0) {

        if($_SERVER["REQUEST_METHOD"] == 'POST')
        {
            $formerr = array();
            $fname = $_FILES["img"]['name'];
            $ftype = $_FILES["img"]["type"];
            $ftemp = $_FILES["img"]["tmp_name"];
            $fsize = $_FILES["img"]["size"];

            $allowextin = array("gif","png","jpg","jpeg");
            $extion = explode(".",$fname);
            $extion = end($extion);
            $extion = strtolower($extion);

            if(empty($fname))
            {
                $formerr[] = "img can't be <b>Empty</b>";
            }
            if(!empty($fname))
            {
                if(!in_array($extion,$allowextin))
                {
                    $formerr[] = "this extion is not Allowed";
                }
                if($fsize > 4194304)
                {
                    $formerr[] = "this image greater than <B>4MB</B>";
                }
            }
            if(empty($formerr))
            {
                $image = rand(0,1000)."_".$fname;
                $path = "C:\\xampp\\htdocs\\php_mah\\social\\upload\\avatar\\";
                move_uploaded_file($ftemp,$path.$image);

                $stmt = $con->prepare("UPDATE users SET img = ? WHERE ID = ?");
                $stmt->execute(array($image,$_SESSION["uid"]));
                $count = $stmt->rowCount();
                if($count > 0)
                {
                    $suc = "<div class ='alert alert-success text-center'>This Image is Update Successfully</div>";
                    redirect($suc,'back',2);
                }
            }
        }
       
?>
        <div class="homepage">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="image_card text-center oldimage">
                            <?php
                            if($pic["img"] == 0)
                            {
                                ?>
                                <img src="../../../../php_mah/social/include/template/layout/img/imagedefalut.png" alt="">
                                <?php
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo $path.$pic["img"]; ?>" alt="">
                                <?php
                            }
                            ?>
                        </div>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='POST' enctype="multipart/form-data">
                            <div class="form-group" style="position: relative;">
                                <input type="file" class="form-control" name="img">
                                <span class="customfile">upload new photo <i class="fa fa-upload"></i></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="save" class="btn btn-info sub">
                            </div>
                            <div class="form-group">
                                <?php
                                if(!empty($formerr))
                                {
                                    foreach($formerr as $err)
                                    {
                                        ?>
                                        <div class="alert alert-danger"><?php echo $err; ?></div>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>
<?php

    } else {
                       
        if($_SERVER["REQUEST_METHOD"] == 'POST')
        {
            $formerr = array();
            $fname = $_FILES["img"]['name'];
            $ftype = $_FILES["img"]["type"];
            $ftemp = $_FILES["img"]["tmp_name"];
            $fsize = $_FILES["img"]["size"];

            $allowextin = array("gif","png","jpg","jpeg");
            $extion = explode(".",$fname);
            $extion = end($extion);
            $extion = strtolower($extion);

            if(empty($fname))
            {
                $formerr[] = "img can't be <b>Empty</b>";
            }
            if(!empty($fname))
            {
                if(!in_array($extion,$allowextin))
                {
                    $formerr[] = "this extion is not Allowed";
                }
                if($fsize > 4194304)
                {
                    $formerr[] = "this image greater than <B>4MB</B>";
                }
            }
            if(empty($formerr))
            {
                $image = $fname . "_" . rand(0,1000);
                $path = "C:\\xampp\\htdocs\\php_mah\\social\\upload\\avatar\\";
                move_uploaded_file($ftemp,$path.$image);

                $stmt = $con->prepare("UPDATE users SET img = ? WHERE ID = ?");
                $stmt->execute(array($image,$_SESSION["uid"]));
                $count = $stmt->rowCount();
                if($count > 0)
                {
                    $suc = "<div class ='alert alert-success text-center'>This Image is Update Successfully</div>";
                }
            }
        }
?>
        <div class="homepage">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="image_card text-center oldimage">
                        <?php
                            if($pic["img"] == 0)
                            {
                                ?>
                                <img src="../../../../php_mah/social/include/template/layout/img/imagedefalut.png" alt="">
                                <?php
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo $path.$pic["img"]; ?>" alt="">
                                <?php
                            }
                            ?>
                        </div>
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method='POST' enctype="multipart/form-data">
                            <div class="form-group" style="position: relative;">
                                <input type="file" class="form-control" name="img">
                                <span class="customfile">upload new photo <i class="fa fa-upload"></i></span>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="save" class="btn btn-info sub">
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-3"></div>
                </div>
            </div>
        </div>
<?php
    }
    include $foot;
    ob_end_flush();
} else {
    header("login.php");
}
