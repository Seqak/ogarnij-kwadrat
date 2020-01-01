<?php

class Language{

    public function checkLanguage(){
        
        if (isset($_SESSION['language'])) {
            
            if($_SESSION['language'] == 'pl'){
                include  '../languages/pl.php';  
            }
            elseif ($_SESSION['language'] == 'eng') {
                include '../languages/eng.php';
            }
            elseif ($_SESSION['language'] == 'ru') {
                include '../languages/ru.php';
            }
        }
        else{
            include '../languages/pl.php';
            $_SESSION['language'] = "pl";    
        }

        return $translateArray;
    }
}


?>