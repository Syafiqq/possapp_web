<?php
$host = 'localhost';
$user = 'root';
$pass = 'Muhammad_Syafiq';
$db = 'posapp';
$connect = mysqli_connect($host, $user, $pass, $db) or die('CONNECTION ERROR ');
//mysqli_select_db($db,$connect) or die('DATABASE ERROR');

function base_url($path)
{
    return "https://{$_SERVER['SERVER_NAME']}/$path";
}

function site_url($path)
{
    return "https://{$_SERVER['SERVER_NAME']}/index.php/$path";
}

?>
