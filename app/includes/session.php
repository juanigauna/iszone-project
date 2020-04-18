<?php
//$geo = new geoPlugin();
//$geo->locate();
$n['user_city'] = '';//trim($geo->city);
$n['user_regionName'] =  '';//trim($geo->regionName);
$n['user_countryName'] = '';//trim($geo->countryName);
$n['user_location'] = trim($n['user_city'].', '.$n['user_regionName'].', '.$n['user_countryName'].'.');
if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $n['logged_in'] = true;
} else {
    $n['logged_in'] = false;
}