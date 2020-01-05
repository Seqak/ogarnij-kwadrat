<?php
session_start();
require('../vendor/autoload.php');
require('../model/dbconnect.php');
require_once("language.php");
require_once('../model/includes/getallflats.php');
require_once('../model/includes/getalladdress.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if( isset($_GET['lang'])){
    $_SESSION['language'] = $_GET['lang'];
}

$lang = new Language();
$translateArray = $lang->checkLanguage();

$getAllFlats = new GetAllFlats();
$allFlats = $getAllFlats->getFlats();

// var_dump($allFlats);


$getAllAddresses = new GetAllAddress();
$allAddresses = $getAllAddresses->getAddresses();
// var_dump($allAddresses);





$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('flatlist.html', array(
    'translate' =>  $translateArray ?? null,

));


?>