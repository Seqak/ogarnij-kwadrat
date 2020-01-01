<?php
session_start();
require('../vendor/autoload.php');
require_once("language.php");
require_once("includes/datasanitaze.php");
require_once("includes/formvalidate.php");


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if( isset($_GET['lang'])){
    $_SESSION['language'] = $_GET['lang'];
}

$lang = new Language();
$translateArray = $lang->checkLanguage();

for ($i=0; $i <= 4 ; $i++) { 
    $errors[] = false;
}

if (isset($_POST['addFlat-submit'])) {

    $formValidate = new FormValidate();
    $_POST = $formValidate->roomValidate($_POST);

    $dataSanitaze = new DataSanitaze();
    $sanitased = $dataSanitaze->sanitaze($_POST);

    $errors = $formValidate->flatValidate($sanitased);

    
  
    
}




$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('newflat.html', array(
    'translate' =>  $translateArray ?? null,
    'errors' => $errors,
    
));


?>