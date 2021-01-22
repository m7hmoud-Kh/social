<?php
function gettitile()
{
    global $title;
    if (isset($title)) {
        echo $title;
    } else {
        echo "defalut";
    }
}


function redirect($themeg,$url=null,$sec = 3)
{
    if($url == null)
    {
        $url = "index.php";
    }
    if($url == 'login')
    {
        $url = 'login.php';
    }
    else {
        if (isset($_SERVER["HTTP_REFERER"]) && $_SERVER["HTTP_REFERER"] !== "") {
            $url = $_SERVER["HTTP_REFERER"];
        }
    }
    echo $themeg;
    echo "<div class='alert alert-info text-center'>You will Redirect  after $sec second</div>";
    header("refresh:$sec;url=$url");
    exit();

}