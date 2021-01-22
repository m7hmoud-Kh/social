<?php
ob_flush();
session_start();
$title = "chating Room";
if (isset($_SESSION["email"])) {
    include "init.php";
    if (isset($_GET["friend"]) && is_numeric($_GET["friend"])) {
        $friendid = filter_var($_GET["friend"], FILTER_SANITIZE_NUMBER_INT);

        $stmt = $con->prepare("SELECT * FROM users WHERE ID =?");
        $stmt->execute(array($friendid));
        $info = $stmt->fetch();
        $count = $stmt->rowCount();

        $stmt = $con->prepare("SELECT * FROM users WHERE ID = ?");
        $stmt->execute(array($_SESSION["uid"]));
        $infome = $stmt->fetch();

        $path = "../../../../php_mah/social/upload/avatar//";
        if ($infome["ID"] > $info["ID"]) {
            $cahtid = $infome["ID"] . $info["ID"];
        } else {
            $cahtid = $info["ID"] . $infome["ID"];
        }
        if ($count == 0) {
            header("location:index.php");
            exit();
        } else {
            if ($_SERVER["REQUEST_METHOD"] == 'POST') {

                $meg = filter_var($_POST["meg"], FILTER_SANITIZE_STRING);

                $formerr = array();

                if (empty($meg)) {
                    $formerr[] = "please type anything in input";
                }
                if (empty($formerr)) {

                    $stmt = $con->prepare("INSERT INTO chat (chat_id , sender  , other , meg , `date` , `time`) VALUES( :c , :s ,:o , :m , now() , now() )");
                    $stmt->execute(array(
                        'c' => $cahtid,
                        's' => $infome["ID"],
                        'o' => $info["ID"],
                        'm' => $meg,
                    ));
                }
            }
            $stmt = $con->prepare("SELECT users.* , chat.* FROM users INNER JOIN chat ON chat.sender = users.ID WHERE chat.chat_id = ? ORDER BY `time` ASC");
            $stmt->execute(array($cahtid));
            $rows = $stmt->fetchAll();

?>
            <div class="homepage">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="heading">
                                <?php echo ucfirst($info["fname"]) . " " . ucfirst($info["lname"]); ?>
                            </div>
                            <div class="bodyheading">
                                <div class="chat_box">
                                    <div class="row">
                                        <?php
                                        foreach ($rows as $row) {
                                            if ($row["sender"] == $_SESSION["uid"]) {
                                        ?>
                                                <div class="by_me col-lg-12 text-left">
                                                    <div class="imageuser">
                                                        <?php
                                                        if ($infome["img"] == 0) {
                                                        ?>
                                                            <img src="../../../../php_mah/social/include/template/layout/img/imagedefalut.png" alt="">
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <img src="<?php echo $path . $infome["img"]; ?>" alt="">
                                                        <?php
                                                        }
                                                        ?>
                                                        <div class="chatme">
                                                            <div><?php echo $row["time"]; ?></div> <?php echo $row["meg"]; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php
                                            } elseif ($row["sender"] ==  $info["ID"]) {
                                            ?>
                                                <div class="by_other col-lg-12 text-right">
                                                    <div class="imageuser">
                                                        <div class="chatother">
                                                            <div><?php echo $row["time"]; ?></div> <?php echo $row["meg"]; ?>
                                                        </div>
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
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="typechat">
                                    <form action="<?php echo $_SERVER["PHP_SELF"] . "?friend=" . $info["ID"]; ?>" method="POST">
                                        <input type="text" placeholder="type your message" name="meg">
                                        <button type="submit" class="btn btn-successs">
                                            <i class="fas fa-chevron-right"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                        </div>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        header("location:index.php");
    }
    include $foot;
} else {
    header("location:login.php");
    exit();
}
ob_end_flush();


/***
 * unlink() put param file of image and remove it when you delete from database
 */
