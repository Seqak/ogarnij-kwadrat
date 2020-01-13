<?php
session_start();

require('../vendor/autoload.php');
require('../model/dbconnect.php');
require_once("language.php");
require_once('../model/includes/getallflats.php');
require_once('../model/includes/getalladdress.php');
require_once('../model/flat.php');
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


$getAllFlats = new GetAllFlats();
$allFlats = $getAllFlats->getFlats();

// var_dump($allFlats);


$getAllAddresses = new GetAllAddress();
$allAddresses = $getAllAddresses->getAddresses();
// var_dump($allAddresses);

$inner = $getAllFlats->getRecord();



// echo "<pre>"; print_r($inner);  "</pre>";
// dump($inner);



array_walk($inner, function (& $item){
     $item['rooms'] = $item['COUNT(r.flat_id)'] ;
     unset($item['COUNT(r.flat_id)']);
});


for ($i=0; $i <= count($allFlats) -1 ; $i++) { 

    $flatsObjArray[] = new flatListRecord();

    $flatsObjArray[$i]->setFlatId($inner[$i]['flat_id']);
    $flatsObjArray[$i]->setCity($inner[$i]['city']);
    $flatsObjArray[$i]->setStreet($inner[$i]['street']);
    $flatsObjArray[$i]->setNumber($inner[$i]['number']);
    $flatsObjArray[$i]->setRooms($inner[$i]['rooms']);

}

// echo "<pre>"; print_r($inner);  "</pre>";


// echo "<pre>"; print_r($flatsObjArray);  "</pre>";




$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('flatlist.html', array(
    'translate' =>  $translateArray ?? null,
    'adres' => $allAddresses,
    'flatz' => $flatsObjArray,

));


?>