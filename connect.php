<?php 

$host = "mysql:host=localhost;dbname=social_media";
$user = "root";
$pass = "";

try
{
    $con = new PDO($host,$user,$pass);
    $con->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "failed to connect " . $e->getMessage();
}