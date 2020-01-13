<?php
session_start();
require('../vendor/autoload.php');
require('../model/dbconnect.php');

require_once('../model/user.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if( isset($_GET['lang'])){
    $_SESSION['language'] = $_GET['lang'];
}

$lang = new App\Change\Language\Language();
$translateArray = $lang->checkLanguage();

$user_id = $_SESSION['user_id'];

$user = new User();
$user->setUserName($user_id);
$userName = $user->getUserName();








$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('index.html', array(
    'translate' =>  $translateArray ?? null,
    'userName' =>  $userName,

));


?>