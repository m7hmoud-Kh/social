<?php
$title = "Edit";
session_start();
if (isset($_SESSION["email"])) {
    include "init.php";
    if ($_SERVER["REQUEST_METHOD"] == 'POST') {
        $formerr = array();

        $fname  = $_POST["fname"];
        $lname  = $_POST["lname"];
        $email  = $_POST["email"];
        $pass   = $_POST["pass"];
        $gender = $_POST["gender"];
        $age    = $_POST["age"];
        $city   = $_POST['city'];
        $soc    = $_POST["soc"];

        if (empty($fname)) {
            $formerr[] = "frist name can't be <b>Empty</b>";
        }
        if (empty($lname)) {
            $formerr[] = "last name can't be <b>Empty</b>";
        }
        if (empty($email)) {
            $formerr[] = "Email can't be <b>Empty</b>";
        }
        if (empty($pass)) {
            $formerr[] = "Password can't be <b>Empty</b>";
        }
        if ($gender == 0) {
            $formerr[] = "Gender can't be <b>Empty</b>";
        }
        if ($age == 0) {
            $formerr[] = "Age can't be <b>Empty</b>";
        }
        if ($city == 0) {
            $formerr[] = "City can't be <b>Empty</b>";
        }
        if ($soc == 0) {
            $formerr[] = "Social Status can't be <b>Empty</b>";
        }

        if (empty($formerr)) {
            $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND ID != ?");
            $stmt->execute(array($email, $_SESSION["uid"]));
            $count = $stmt->rowCount();
            if ($count > 0) {
                $formerr[] = "this email is alredy <b> exist </b> sir";
            } else {
                $stmt = $con->prepare("UPDATE users SET fname = ? , lname = ? , email = ? , pass = ? , gender = ? , age = ? , city = ? , soc = ?  WHERE ID = ? ");
                $stmt->execute(array($fname, $lname, $email, $pass, $gender, $age, $city, $soc, $_SESSION["uid"]));
                $count = $stmt->rowCount();
                if ($count > 0) {
                    $suc = "<div class='alert alert-success'>this profile is <b>Update</b></div>";
                }
            }
        }
    }
?>
    <?php
    $stmt = $con->prepare("SELECT * FROM users WHERE ID = ?");
    $stmt->execute(array($_SESSION["uid"]));
    $info = $stmt->fetch();
    ?>
    <div class="homepage">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="heading">
                        Edit
                    </div>
                    <div class="bodyheading">
                        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                            <input type="hidden" value="<?php echo $info["ID"]; ?>" name="userid">
                            <div class="form-group">
                                <label for="fname" class="disblock">frist name</label>
                                <input type="text" name="fname" class="form-control col-lg-9 disblock" value="<?php echo $info["fname"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="fname" class="disblock">last name</label>
                                <input type="text" name="lname" class="form-control col-lg-9 disblock" value="<?php echo $info["lname"]; ?>">
                            </div>
                            <div class="form-group">
                                <label for="fname" class="disblock">email</label>
                                <input type="email" name="email" class="form-control col-lg-9 disblock" style="margin-left: 6%;" value="<?php echo $info["email"]; ?>" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="fname" class="disblock">Password</label>
                                <input type="password" name="pass" class="form-control col-lg-9 disblock" value="<?php echo $info["pass"]; ?>" autocomplete="new-password">
                            </div>
                            <div class="form-group">
                                <label for="gender" class="disblock">gender</label>
                                <select name="gender" id="gender" class="form-control editselect" style="margin-left: 2.5%;">
                                    <option value="0">gender</option>
                                    <option value="1" <?php if ($info["gender"] == 1) {
                                                            echo "selected";
                                                        } ?>>male</option>
                                    <option value="2" <?php if ($info["gender"] == 2) {
                                                            echo "selected";
                                                        } ?>>female</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="age" class="disblock">age</label>
                                <select name="age" id="age" class="form-control editselect">
                                    <option value="0">select age</option>
                                    <?php
                                    for ($i = 18; $i <= 50; $i++) {
                                    ?>
                                        <option value="<?php echo $i; ?>" <?php if ($info["age"] == $i) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $i . " Years"; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="city" class="disblock">City</label>
                                <select name="city" id="city" class="form-control editselect">
                                    <option value="0">select city</option>
                                    <option value="1" <?php if ($info["city"] == 1) {
                                                            echo "selected";
                                                        } ?>>القاهره</option>
                                    <option value="2" <?php if ($info["city"] == 2) {
                                                            echo "selected";
                                                        } ?>>الاسكندريه</option>
                                    <option value="3" <?php if ($info["city"] == 3) {
                                                            echo "selected";
                                                        } ?>>الجيزه</option>
                                    <option value="4" <?php if ($info["city"] == 4) {
                                                            echo "selected";
                                                        } ?>>المنوفيه</option>
                                    <option value="5" <?php if ($info["city"] == 5) {
                                                            echo "selected";
                                                        } ?>>اسيوط</option>
                                    <option value="6" <?php if ($info["city"] == 6) {
                                                            echo "selected";
                                                        } ?>>قنا</option>
                                    <option value="7" <?php if ($info["city"] == 7) {
                                                            echo "selected";
                                                        } ?>>سوهاج</option>
                                    <option value="8" <?php if ($info["city"] == 8) {
                                                            echo "selected";
                                                        } ?>>اسوان</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="soc" class="disblock">social</label>
                                <select name="soc" id="" class="form-control editselect">
                                    <option value="0">social status</option>
                                    <option value="1" <?php if ($info["soc"] == 1) {
                                                            echo "selected";
                                                        } ?>>single</option>
                                    <option value="2" <?php if ($info["soc"] == 2) {
                                                            echo "selected";
                                                        } ?>>married</option>
                                    <option value="3" <?php if ($info["soc"] == 3) {
                                                            echo "selected";
                                                        } ?>>widow</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="save" class="btn btn-success logedit">
                            </div>
                            <div class="form-group">
                                <?php
                                if (!empty($formerr)) {
                                    foreach ($formerr as $err) {
                                ?>
                                        <div class="alert alert-danger"><?php echo $err; ?></div>
                                <?php
                                    }
                                }
                                if (isset($suc)) {
                                    echo $suc;
                                }
                                ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-3"></div>
        </div>
    </div>
    </div>
<?php
    include $foot;
} else {
    header("location:login.index");
}
