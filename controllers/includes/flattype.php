<?php

namespace Controllers\Includes\FlatType;

class FlatType{

    public function type($data){
        if(($data[1] == true) && ($data[2] == true)){
            return 1;
        }
        elseif ($data[1] == true) {
            return 2;
        }
        elseif ($data[2] ==true) {
            return 3;
        }
        elseif ($data[0] == true) {
            return 4;
        }


    }
}