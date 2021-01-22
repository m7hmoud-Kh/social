<?php 

$connect = "C:\\xampp\\htdocs\\php_mah\\social\\connect.php";
include $connect ;

$fun = "C:\\xampp\\htdocs\\php_mah\\social\\include\\function\\";
include $fun."fun.php";
$tmpl =  "C:\\xampp\\htdocs\\php_mah\\social\\include\\template\\";

$css = "../social/include/template/layout/css//";
$js  = "../social/include/template/layout/js//";

include $tmpl . "header.php";
if(!isset($nonav)){include $tmpl . "nav.php";}
$foot = $tmpl . "footer.php";