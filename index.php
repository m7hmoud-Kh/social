<?php
session_start();
$title = "Home";
if (isset($_SESSION["email"])) {
    include "init.php"; ?>
    
    <div class="container-fluid">
        <div class="homepage">
            <div class="row">
                <?php include $tmpl . "ads.php"; ?>
                <?php include $tmpl . "ser.php"; ?>
            </div>
            <div class="row">
                <div class="col-lg-3"></div>
                <?php include $tmpl . "viewuser.php"; ?>
                <?php include $tmpl . "control.php"; ?>
            </div>
        </div>
    </div>


<?php include $foot;
} else {
    header("location:login.php");
}
