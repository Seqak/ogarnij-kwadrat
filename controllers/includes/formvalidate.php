<?php

class FormValidate{

    public function roomValidate($post){

        if (!isset($post["flat-checkbox"]) && isset($post['rooms'])) {
            unset($post['rooms']);
        }
        elseif (isset($post["flat-checkbox"]) && !isset($post['rooms'])) {
            unset($post['flat-checkbox']);
        }

        return $post;
    }

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

}



?>