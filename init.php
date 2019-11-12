<?php
require_once('functions.php');
require_once('./vendor/autoload.php');
//require_once('config.php');
//Dislay Error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
//Start session
session_start();
//Decect page
$page = detectPage();
$currentUser = null;
//Connect Database
$db = new PDO('mysql:host=localhost;dbname=demo1;charset=utf8', 'root', '');
//Decent login
$currentUser = null;

if (isset($_SESSION['userId']))
{
    $currentUser = findUserById($_SESSION['userId']);
}