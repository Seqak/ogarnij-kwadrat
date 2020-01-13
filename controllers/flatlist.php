<?php
session_start();

require('../vendor/autoload.php');
require('../model/dbconnect.php');
require_once('../model/includes/flatrecords.php');
require_once('../model/flat.php');
require_once('../model/includes/flatlistrecord.php');
// use Model\Includes\FlatRecords as FlatRecords;


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if( isset($_GET['lang'])){
    $_SESSION['language'] = $_GET['lang'];
}

$lang = new App\Change\Language\Language();
$translateArray = $lang->checkLanguage();


$getFlatRecords = new GetFlatRecords();
$flatRecords = $getFlatRecords->getRecords();


array_walk($flatRecords, function (& $item){
     $item['rooms'] = $item['COUNT(r.flat_id)'] ;
     unset($item['COUNT(r.flat_id)']);
});


for ($i=0; $i <= count($flatRecords) -1 ; $i++) { 

    $flatsObjArray[] = new flatListRecord();

    $flatsObjArray[$i]->setFlatId($flatRecords[$i]['flat_id']);
    $flatsObjArray[$i]->setCity($flatRecords[$i]['city']);
    $flatsObjArray[$i]->setStreet($flatRecords[$i]['street']);
    $flatsObjArray[$i]->setNumber($flatRecords[$i]['number']);
    $flatsObjArray[$i]->setRooms($flatRecords[$i]['rooms']);

}


$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('flatlist.html', array(
    'translate' =>  $translateArray ?? null,
    'flatz' => $flatsObjArray,
    'flatAdded' => $flatAddStatus ?? null,

));


?>