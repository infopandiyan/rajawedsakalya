<?php
session_start();
ob_start();
date_default_timezone_set('UTC');

$datetime = date("Y-m-d H:i:s");

$dt = new DateTime($datetime);
$tz = new DateTimeZone('Asia/Kolkata'); // or whatever zone you're after

$dt->setTimezone($tz);

if($_POST){
$myFile = "savedata.json";
$finaldata = file_get_contents($myFile);
echo $finaldata;
}