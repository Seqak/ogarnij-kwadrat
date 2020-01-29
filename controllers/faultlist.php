<?php
session_start();

require('../vendor/autoload.php');
require('../model/dbconnect.php');
require('../model/includes/faultrecords.php');
require('../model/includes/faultlistrecord.php');



if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if( isset($_GET['lang'])){
    $_SESSION['language'] = $_GET['lang'];
}

$lang = new App\Change\Language\Language();
$translateArray = $lang->checkLanguage();

if (isset($_SESSION['faultAddStatus'])) {
    $flatAddStatus = $_SESSION['faultAddStatus'];
    unset($_SESSION['faultAddStatus']); 
}

$getRecords = new GetFaultRecords();
$records = $getRecords->getRecords();



for ($i=0; $i <= count($records) -1 ; $i++) { 

    $faultsObjArray[] = new FaultListRecord();

    $faultsObjArray[$i]->setFaultId($records[$i]['fault_id']);
    $faultsObjArray[$i]->setCity($records[$i]['city']);
    $faultsObjArray[$i]->setStreet($records[$i]['street']);
    $faultsObjArray[$i]->setNumber($records[$i]['number']);
    $faultsObjArray[$i]->setStatusName($records[$i]['status_name']);
    $faultsObjArray[$i]->setStatusId($records[$i]['status_id']);
    $faultsObjArray[$i]->setTypeName($records[$i]['type_name']);
    $faultsObjArray[$i]->setData($records[$i]['add_date']);
    $faultsObjArray[$i]->setCritical($records[$i]['critical']);
    $faultsObjArray[$i]->setUserName($records[$i]['user_name']);
    $faultsObjArray[$i]->setUserSurname($records[$i]['user_surname']);
  
}


// echo "<pre>"; print_r($records); echo "</pre>";







$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('faultlist.html', array(
    'translate' =>  $translateArray ?? null,
    'faultAdded' => $flatAddStatus ?? null,
    'faults' => $faultsObjArray,

));


?>
