<?php

namespace Controllers\Includes\DataSanitaze;

class DataSanitaze{


    public function sanitazeOne($data){
        $data = htmlspecialchars($data);
        return $data;
    }

    public function sanitaze($data){

        foreach ($data as $value) {
            $sanitazed[] = htmlspecialchars($value);       
        }

        return $sanitazed;
    }
}



?>