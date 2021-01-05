<?php

class Zirniai {

    private $id, $count;
    public $imgPath = 1;

    // public $propertyName;

    public static function nuimtiDerliu($visiZirniai) // <----- $visiAgurkai = $_SESSION['obj']
    {
        foreach($visiZirniai as $index => $zirnis) { // <---- serializuotas stringas
            $zirnis = unserialize($zirnis); // <----- agurko objektas
            $zirnis->nuskintiVisus();
            $zirnis = serialize($zirnis); // <------ vel stringas
            $visiAgurkai[$index] = $zirnis; // <----- uzsaugom agurkus
        }
        return $visiZirniai;
    }

    public function __construct($lastId) 
    {
        $this->id = $lastId + 1;
        $this->count = 0;
        $this->imgPath = rand(1, 5);

        // $agurkoObj->id = $_SESSION['agurku ID'] + 1;
        // $agurkoObj->count = 0;
    }


    public function __get($propertyName) 
    {
        return $this->$propertyName;
    }

    public function __set($propertyName, $value) 
    {
        $this->$propertyName = $value;
    }

    public function addVegatable($zirniai)
    {
        $this->count = $this->count + $zirniai;
    }

    public function removeVegatable($zirniai)
    {
        if($zirniai < 0){
            $_SESSION['err'] = 1; 
        }
        elseif($zirniai > $this->count ){
            $_SESSION['err'] = 3;  
        } else{

        $this->count -= $zirniai;
        }
    }

    public function removeAllVegatables($zirniai)
    {
        if($zirniai == $this->id) {
            $this->count = 0;
            }
    }

    public function nuskintiVisus()
    {
        $this->count = 0;
    }

    // Visai nebutina
    // public function __serialize() // <---- ivyksta kai objektas yra serializuojamas
    // {

    // }



}