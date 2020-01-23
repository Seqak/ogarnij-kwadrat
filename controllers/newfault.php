<?php
session_start();
require('../vendor/autoload.php');
use Controllers\Includes\DataSanitaze as DataSanitaze;
use Controllers\Includes\FormValidate as FormValidate;

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if( isset($_GET['lang'])){
    $_SESSION['language'] = $_GET['lang'];
}

$lang = new App\Change\Language\Language();
$translateArray = $lang->checkLanguage();

for ($i=0; $i <= 4 ; $i++) { 
    $errors[] = false;
}




$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('newfault.html', array(
    'translate' =>  $translateArray ?? null,
    'errors' => $errors,
    
));

?>