<?php
session_start();
require('../vendor/autoload.php');
require_once("language.php");
require_once("includes/datasanitaze.php");
require_once("includes/formvalidate.php");
require_once("includes/flattype.php");
require_once('../model/flattransaction.php');


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
    $checkedData = $formValidate->roomValidate($_POST);

    $dataSanitaze = new DataSanitaze();
    $sanitased = $dataSanitaze->sanitaze($checkedData);
    $errors = $formValidate->flatValidate($sanitased);
    $isErro = $formValidate->isErro($errors);

    if ($isErro == false) {

        $queryType[0] = true;
        $queryType[1] = $formValidate->isRoom($sanitased);
        $queryType[2] = $formValidate->additionalInfo($sanitased);

        $flatType = new FlatType();
        $type = $flatType->type($queryType);
    
        $flatTransaction = new FlatTransaction();

        if ($type == 4) {
            $flatTransaction->flatTransFour($sanitased);
            header("Location: index.php");
        }
        elseif ($type == 3) {
            $flatTransaction->flatTransThree($sanitased);
            header("Location: index.php");
        }
        elseif ($type == 2) {
            $flatTransaction->flatTransTwo($sanitased);
            header("Location: index.php");
        }
        elseif ($type == 1) {
            $flatTransaction->flatTransOne($sanitased);
            header("Location: index.php");
        }
    }
}

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('newflat.html', array(
    'translate' =>  $translateArray ?? null,
    'errors' => $errors,
    
));

?>