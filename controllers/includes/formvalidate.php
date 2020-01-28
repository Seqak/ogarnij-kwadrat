<?php

namespace Controllers\Includes\FormValidate;

class FormValidate{

    //Method that services situation when someone try crash checkbox or room's input.
    public function roomValidate($post){

        if (!isset($post["flat-checkbox"]) && isset($post['rooms'])) {
            unset($post['rooms']);
        }
        elseif (isset($post["flat-checkbox"]) && !isset($post['rooms'])) {
            unset($post['flat-checkbox']);
        }
        return $post;
    }

    //Method that checks if all fields are filled.
    public function flatValidate($data){
        
        if (count($data) <= 5) {

            for ($i = 0; $i <= 3; $i++) { 
               
                if (empty($data[$i])) {
                    $result[] = true;   
                }
                else{
                    $result[] = false;
                }
            }

            $result[4] = false;
        }
        else{

            foreach ($data as $value) {

                if (empty($value)) {
                    $result[] = true;   
                }
                else{
                    $result[] = false;
                }
            }

            if ($data[4] <= 0) {
                $result[4] = true;
            }
        }

        return $result;
    }

    //Method that checks if Additional info is exist.
    public function additionalInfo($data){

        $dataLenght = count($data);
        
         if ( $dataLenght == 5) {
            if (empty($data[3])) {
                return false;
            }
            else{
                return true;
            }
         }
         else{
            if (empty($data[5])) {
                
                return false;
            }
            else{
                return true;
            }
        }
    }

    //Method that checks if a flat is with rooms.
    public function isRoom($data){

        $dataLenght = count($data);

        if ($dataLenght > 5) {
            if ($data[4] > 0) {
                // echo "Są pokoje";
                return true;
            }
        }
        else{
            // echo "Nie ma pokoi";
                return false;
        }
    }

    // Method that checks if data have some warnings to dispaly or form was filled correctly.
    public function isErro($data){

        if (count($data) <= 5) {
            $erro = false;
            for ($i = 0; $i <= 2; $i++) {
                if ($data[$i] == true) {
                    $erro = true;
                }  
            }
        }
        else{
            $erro = false;
            for ($i = 0; $i <= 4; $i++) {
                if ($data[$i] == true) {
                    $erro = true;
                }  
            }
        }
        return $erro;
    }



    //Faults

    public function faultDescription($arg){

        if (count($arg) == 4) {
            if (empty($arg[2])) {
                
                return true;
            }
            else{
                return false;
            }
        }
        elseif (count($arg) == 5) {
            if (empty($arg[3])) {
                
                return true;
            }
            else{
                return false;
            }
        }

    }

    
}



?>