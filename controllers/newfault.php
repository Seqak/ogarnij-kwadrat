<?php
session_start();
require('../vendor/autoload.php');
use Controllers\Includes\DataSanitaze as DataSanitaze;
use Controllers\Includes\FormValidate as FormValidate;
require_once('../model/faulttypes.php');
require_once('../model/includes/getaddresses.php');
require_once('../model/flatsaddress.php');
require_once('../model/newfaulttransaction.php');


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

$faultTypes = new Faulttypes();
$faultTyp = $faultTypes->getTypes();

$getAdresses = new GetAddresses();
$adresses = $getAdresses->getAddress();



for ($i=0; $i <= count($adresses) -1 ; $i++) { 

    $flatsObjArray[] = new FlatsAddress();

    $flatsObjArray[$i]->setAddressId($adresses[$i]['address_id']);
    $flatsObjArray[$i]->setCity($adresses[$i]['city']);
    $flatsObjArray[$i]->setStreet($adresses[$i]['street']);
    $flatsObjArray[$i]->setNumber($adresses[$i]['number']);

}

if (isset($_POST['addFault-submit'])) {
    
    $dataSanitaze = new DataSanitaze\DataSanitaze();
    $sanitazed = $dataSanitaze->sanitaze($_POST);

    $formValidate = new FormValidate\FormValidate();
    $erro = $formValidate->faultDescription($sanitazed);

    if (count($_POST) == 4) {
        $critical = false;
    }
    elseif (count($_POST) == 5) {
        $critical = true;
    }

    if ($erro == false) {

        $date = date("Y-m-d H:i:s");

        $transaction = new NewFaultTransaction();

        if (count($_POST) == 4) {

            $faultData = array( $sanitazed[0], $sanitazed[1], $sanitazed[2], $_SESSION['user_id'], $date, $critical);

            $transaction->addFault($faultData);
        

        }else{
            $faultData = array( $sanitazed[0], $sanitazed[2], $sanitazed[3], $_SESSION['user_id'], $date, $critical);

            $transaction->addFault($faultData);
    
        }

    }
    // echo "<pre>";
    // var_dump($faultData);echo "</pre>";
    // echo "<pre>"; print_r($sanitazed);  echo "</pre>";
}



$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('newfault.html', array(
    'translate' =>  $translateArray ?? null,
    'errors' => $errors,
    'types' => $faultTyp,
    'flats' => $flatsObjArray,
    'erro' => $erro ?? null,
));

?>