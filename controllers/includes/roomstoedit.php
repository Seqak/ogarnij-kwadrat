<?php

namespace Controllers\Includes\RoomsToEdit;

class RoomsToEdit{

    public function roomsAmount($oldAmount, $newAmount){

        $result = array();

        if ( $oldAmount > $newAmount) {

            $result[0] = ($oldAmount - $newAmount);
            $result[1] = false;

            return $result;

        }
        elseif ($oldAmount < $newAmount) {
            $result[0] = ($newAmount - $oldAmount);
            $result[1] = true;

            return $result;
        }


    }


}