<?php
session_start();
require('../vendor/autoload.php');
require('../model/dbconnect.php');
require_once('../model/includes/flatrecords.php');
require_once('../model/editflattransaction.php');
use Controllers\Includes\DataSanitaze as DataSanitaze;
use Controllers\Includes\FormValidate as FormValidate;
use Controllers\Includes\FlatType as FlatType;
use Controllers\Includes\RoomsToEdit as RoomsToEdit;
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
    $_SESSION['editflat_id'] = $flatId;

    if ($_GET['infoId'] == null) {
        $infoId = 0;
    }
    else{
        $infoId = $_GET['infoId'];
    }

    $_SESSION['info_id'] = $infoId;
    $_SESSION['address_id'] = $_GET['address'];
}

for ($i=0; $i <= 4 ; $i++) { 
    $errors[] = false;
}

$getFlatRecords = new GetFlatRecords();
$flatRecord = $getFlatRecords->getOneRecord($_SESSION['editflat_id']);
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

$_SESSION['roomsAmount'] = $flatsObjArray->rooms;

// echo "<pre>"; print_r($flatsObjArray); echo "</pre>";

if (isset($_POST['editFlat-submit'])) {

    $formValidate = new FormValidate\FormValidate();
    $checkedData = $formValidate->roomValidate($_POST);

    $dataSanitaze = new DataSanitaze\DataSanitaze();
    $sanitased = $dataSanitaze->sanitaze($checkedData);
    $errors = $formValidate->flatValidate($sanitased);
    $isErro = $formValidate->isErro($errors);

    $queryType[0] = true;
    $queryType[1] = $formValidate->isRoom($sanitased);
    $queryType[2] = $formValidate->additionalInfo($sanitased);

    $flatType = new FlatType\FlatType();
    $type = $flatType->type($queryType);

    if ($flatsObjArray->rooms > 0) {
        $roomsIds = $getFlatRecords->getRoomsAmount($_SESSION['editflat_id']);
    }
    else{
        $roomsIds = array(0) ;
    }

    // echo "<pre>"; print_r($roomsIds); echo "</pre>";
    $editTransactions = new editflattransaction(); 

    $roomsToEdit = new RoomsToEdit\RoomsToEdit();
    $roomsAmount = $roomsToEdit->roomsAmount($_SESSION['roomsAmount'], $sanitased[4]);
    

    if ($type == 4) {
        $editTransactions->editFlatTransFour($sanitased, $roomsIds, $_SESSION['info_id'], $_SESSION['editflat_id'], $_SESSION['address_id']);
        header("Location: flatlist.php");
    }
    elseif ($type == 3) {

        $txt = $sanitased[3];
        $editTransactions->editFlatTransThree($sanitased, $roomsIds, $_SESSION['info_id'], $_SESSION['editflat_id'], $_SESSION['address_id']);
        header("Location: flatlist.php");
       
    }
    elseif ($type == 2) {
        
        $editTransactions->editFlatTransTwo($sanitased, $roomsIds, $_SESSION['info_id'],$_SESSION['editflat_id'], $_SESSION['address_id'], $roomsAmount, $_SESSION['roomsAmount']);
        header("Location: flatlist.php");
        
    }
    elseif ($type == 1) {
        
    }

    // echo "<pre>"; print_r($sanitased[4]); echo "</pre>";
    
    
}


$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('editflat.html', array(
    'translate' =>  $translateArray ?? null,
    'flat' => $flatsObjArray,
    'errors' => $errors,
    'update' => $_SESSION['editflat_id'] ?? null,
));


/*
*
*           EDYTOWANIE REKORDÓW
*
*   Pkt 7. 
*
*
*
*
*
*
*
*/






?>


