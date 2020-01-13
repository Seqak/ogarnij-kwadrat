<?php
session_start();
use Model\DBconnect;

require('../vendor/autoload.php');

require_once("includes/datasanitaze.php");
// require('../model/dbconnect.php');

require_once('../model/includes/authorize.php');




if( isset($_GET['lang'])){
    $_SESSION['language'] = $_GET['lang'];
}

$lang = new App\Change\Language\Language();
$translateArray = $lang->checkLanguage();

// Validate system with more OOP v3.
if (isset($_POST['login-btn'])) {

    $dataSanitaze = new DataSanitaze();
    $sanitased = $dataSanitaze->sanitaze($_POST);

    $email = $sanitased[0];
    $password = $sanitased[1];

    if (!empty($email)) {

        $authorize = new Authorize();
        $emailExist = $authorize->checkEmail($email);
    
        if ($emailExist >= 1) {

            $passwordHash = $authorize->checkPassword($email);

            if (password_verify($password, $passwordHash['user_password'])) {
               
                $user = new Model\User\User();
                $user->setUserId($email);
                $userId = $user->getUserId();

                $_SESSION['user_id'] = $userId;
                
                header("Location: index.php");
            }
            else{

                $e_pwd = true;
                $emailValue = $email;
            }
        }
        else{

            $e_email = true;
            $emailValue = " ";
        }

    }
    else{
        $e_email = true;
        $emailValue = " ";
    }

}

//END v3



$loader = new Twig_Loader_Filesystem('../views');
$twig = new Twig_Environment($loader);

echo $twig->render('login.html', array(
    'translate' =>  $translateArray ?? null,
    'test' => $test ?? null,
    'e_email' => $e_email ?? null,
    'e_pwd' => $e_pwd ?? null,
    'emailValue' => $email ?? null,
));

?>