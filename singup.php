<?php
ob_start();
$nonav = "";
$title = "SingUP";
include "init.php";
if ($_SERVER["REQUEST_METHOD"] == 'POST') {
    $fomrerr = array();

    $fname = filter_var($_POST["fname"], FILTER_SANITIZE_STRING);
    $lname = filter_var($_POST["lname"], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST["email"], FILTER_VALIDATE_EMAIL);
    $pass1 = filter_var($_POST["pass1"], FILTER_SANITIZE_STRING);
    $pass2 = filter_var($_POST["pass2"], FILTER_SANITIZE_STRING);
    $age   = filter_var($_POST["age"], FILTER_SANITIZE_NUMBER_INT);



    if (empty($fname)) {
        $fomrerr[] = "Frist name can't be <b>Empty</b>";
    }
    if (empty($lname)) {
        $fomrerr[] = "Last name can't be <b>Empty</b>";
    }
    if (empty($email)) {
        $fomrerr[] = "Email can't be <b>Empty</b>";
    }
    if (empty($pass1)) {
        $fomrerr[] = "Password can't be <b>Empty</b>";
    }
    if (!empty($pass1)) {
        if (!$pass1 == $pass2) {
            $fomrerr[] = "The passwords don't <b>match</b>";
        }
    }
    if ($age == 0) {
        $fomrerr[] = "Select Age can't be <b>Empty</b>";
    }

    if (empty($fomrerr)) {
        $stmt = $con->prepare("SELECT email FROM users WHERE email  = ?");
        $stmt->execute(array($email));
        $count = $stmt->rowCount();
        if ($count > 0) {
            $fomrerr[] = "this email is alredy <b>Exist</b>";
        } else {
            $stmt = $con->prepare("INSERT INTO users (fname , lname , email , pass , age , `data`) 
            VALUES (:f, :l , :e , :p , :a ,now())");
            $stmt->execute(array(
                'f' => $fname,
                'l' => $lname,
                'e' => $email,
                'p' => $pass1,
                'a' => $age,
            ));
            $count = $stmt->rowCount();
            if ($count > 0) {
                $suc = "<div class='alert alert-success text-center'>You Are Login Mr/s $fname </div>";
                redirect($suc, 'login', 3);
            } 
        }
    }
}
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="loginform">
                <h1 class="head text-center">singUp</h1>
                <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
                    <div class="form-group">
                        <span class="formsing"> <i class="fas fa-user"></i> frist name</span>
                        <input type="text" class="form-control" placeholder="type frist name" name="fname">
                    </div>
                    <div class="form-group">
                        <span class="formsing">last name</span>
                        <input type="text" class="form-control" placeholder="type last name" name="lname">
                    </div>
                    <div class="form-group">
                        <span class="formsing"> <i class="far fa-envelope"></i> email</span>
                        <input type="email" class="form-control" placeholder="type vaild email" autocomplete="off" name="email">
                    </div>
                    <div class="form-group">
                        <span class="formsing"> <i class="fa fa-lock"></i> password</span>
                        <input type="password" class="form-control" placeholder="type strong password" autocomplete="new-password" name="pass1">
                    </div>
                    <div class="form-group">
                        <span class="formsing">confirm password</span>
                        <input type="password" class="form-control" placeholder="confirm password" name="pass2">
                    </div>
                    <div class="form-group">
                        <span class="formsing"> <i class="fas fa-calendar-alt"></i> Select Age</span>
                        <select name="age" id="" class="form-control">
                            <option value="0">---</option>
                            <?php
                            for ($i = 18; $i <= 50; $i++) {
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $i . " Years"; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="singUP" class="btn btn-info sub">
                    </div>
                    <div class="form-group">
                        <a href="login.php" class="newuser">login My account</a>
                    </div>
                    <div class="form-group">
                        <?php
                        if (!empty($fomrerr)) {
                            foreach ($fomrerr as $err) {
                        ?>
                                <div class="alert alert-dnager errsing"><?php echo $err; ?></div>
                        <?php
                            }
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-lg-3"></div>
    </div>
</div>
<?php
include $foot;
