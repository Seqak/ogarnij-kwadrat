<?php
session_start();
require('../vendor/autoload.php');
require('../model/dbconnect.php');
require_once('../model/includes/flatrecords.php');
use Controllers\Includes\DataSanitaze as DataSanitaze;
use Controllers\Includes\FormValidate as FormValidate;
use Controllers\Includes\FlatType as FlatType;
// require_once('../model/flattransaction.php');
require_once('../model/includes/flatlistrecord.php');


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if( isset($_GET['lang'])){
    $_SESSION['language'] = $_GET['lang'];
}

$lang = new App\Change\Language\Language();
$translateArray = $lang->checkLanguage();

if (isset($_GET['flatId'])) {
    $flatId = $_GET['flatId'];

    if ($_GET['infoId'] == null) {
        $infoId = 0;
    }
}

for ($i=0; $i <= 4 ; $i++) { 
    $errors[] = false;
}

$getFlatRecords = new GetFlatRecords();
$flatRecord = $getFlatRecords->getOneRecord($flatId);
// echo "<pre>"; print_r($flatRecord); echo "</pre>";

$flatsObjArray = new flatListRecord();

$flatsObjArray->setFlatId($flatRecord['flat_id']);
$flatsObjArray->setAddressId($flatRecord['address_id']);
$flatsObjArray->setInfoId($flatRecord['info_id']);
$flatsObjArray->setCity($flatRecord['city']);
$flatsObjArray->setStreet($flatRecord['street']);
$flatsObjArray->setNumber($flatRecord['number']);
$flatsObjArray->setRooms($flatRecord['COUNT(r.flat_id)']);
$flatsObjArray->setAddInfo($flatRecord['content']);

// echo "<pre>"; print_r($flatsObjArray); echo "</pre>";

// if (isset($_POST['editFlat-submit'])) {

//     $formValidate = new FormValidate\FormValidate();
//     $checkedData = $formValidate->roomValidate($_POST);

//     $dataSanitaze = new DataSanitaze\DataSanitaze();
//     $sanitased = $dataSanitaze->sanitaze($checkedData);
//     $errors = $formValidate->flatValidate($sanitased);
//     $isErro = $formValidate->isErro($errors);

// }

$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('editflat.html', array(
    'translate' =>  $translateArray ?? null,
    'flat' => $flatsObjArray,
    'errors' => $errors,
    
));

?>







?>