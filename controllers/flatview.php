<?php
session_start();
require('../vendor/autoload.php');
require('../model/dbconnect.php');
require_once('../model/includes/flatrecords.php');
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

//Get data to fill info fileds in form.
$getFlatRecords = new GetFlatRecords();
$flatRecord = $getFlatRecords->getOneRecord($_SESSION['editflat_id']);

$flatsObjArray = new flatListRecord();
//Model to dispaly info from db to form fields.
$flatsObjArray->setFlatId($flatRecord['flat_id']);
$flatsObjArray->setAddressId($flatRecord['address_id']);
$flatsObjArray->setInfoId($flatRecord['info_id']);
$flatsObjArray->setCity($flatRecord['city']);
$flatsObjArray->setStreet($flatRecord['street']);
$flatsObjArray->setNumber($flatRecord['number']);
$flatsObjArray->setRooms($flatRecord['COUNT(r.flat_id)']);
$flatsObjArray->setAddInfo($flatRecord['content']);











$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('flatview.html', array(
    'translate' =>  $translateArray ?? null,
    'flat' => $flatsObjArray,
));

?>