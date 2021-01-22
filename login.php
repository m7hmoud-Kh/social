<?php 
session_start();
if(!isset($_SESSION["email"]))
{
$title = "login";
$nonav = "";
include "init.php";

if($_SERVER["REQUEST_METHOD"] == 'POST')
{
    $formerr = array();

    $email = filter_var($_POST["email"],FILTER_SANITIZE_EMAIL);
    $pass  = filter_var($_POST["pass"],FILTER_SANITIZE_STRING);

    if(empty($email))
    {
        $formerr[] = "Email can't be <b>Empty</b>";
    }
    if(empty($pass))
    {
        $formerr[] = "Password can't be <b>Empty</b>";
    }

    if(empty($formerr))
    {
        $stmt = $con->prepare("SELECT * FROM users WHERE email = ? AND pass = ?");
        $stmt->execute(array($email,$pass));
        $info = $stmt->fetch();
        $count = $stmt->rowCount();
        if($count > 0)
        {
            $_SESSION["email"] = $email;
            $_SESSION["uid"]   = $info["ID"];
            header("location:index.php");
        }
    }
}
?>
  <div class="container">
      <div class="loginform">
      <h1 class="head text-center">login</h1>
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="POST">
            <div class="form-group">
                <label for="email">Email</label>
                <input class="form-control" type="email" name="email"
                 placeholder="type your email" id="email" autocomplete="none">
            </div>
            <div class="form-group">
                <label for="pass">Password</label>
                <input class="form-control" type="password" name="pass"
                 placeholder="type your password" id="pass" autocomplete="new-password">
            </div>
            <div class="form-group">
                <input type="submit" value="login" class="sub btn btn-success">
            </div>
            <div class="form-group">
                <a href="singup.php" class="newuser">Creat New Account</a>
            </div>
            <div class="form-group">
                <?php
                if(isset($formerr))
                {
                    foreach($formerr as $err)
                    {
                        ?>
                        <div class="laert alert-danger err"><?php echo $err; ?></div>
                        <?php 
                    }
                }
                ?>
            </div>
        </form>
      </div>
  </div>
<?php
include $foot;
}
else
{
    header("location:index.php");
}
?> 
