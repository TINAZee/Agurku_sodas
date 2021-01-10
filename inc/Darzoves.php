<?php
namespace TINAZee;

use TINAZee\Sodas;

abstract class Darzoves implements Sodas {

    protected $id, $count;
    public $imgPath = 1;

    // public $propertyName;

    public static function nuimtiDerliu($visiAgurkai) // <----- $visiAgurkai = $_SESSION['obj']
    {
        foreach($visiAgurkai as $index => $agurkas) { // <---- serializuotas stringas
            $agurkas = unserialize($agurkas); // <----- agurko objektas
            $agurkas->nuskintiVisus();
            $agurkas = serialize($agurkas); // <------ vel stringas
            $visiAgurkai[$index] = $agurkas; // <----- uzsaugom agurkus
        }
        return $visiAgurkai;
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

    public function addVegatable($agurkai)
    {
        $this->count = $this->count + $agurkai;
    }

    public function removeVegatable($agurkai)
    {
        if($agurkai < 0){
            $_SESSION['err'] = 1; 
        }
        elseif($agurkai > $this->count ){
            $_SESSION['err'] = 3;  
        } else{

        $this->count -= $agurkai;
        }
    }

    public function removeAllVegatables($agurkai)
    {
        if($agurkai == $this->id) {
            $this->count = 0;
            }
    }

    public function nuskintiVisus()
    {
        $this->count = 0;
    }

    abstract public function kiekAugti();

    // Visai nebutina
    // public function __serialize() // <---- ivyksta kai objektas yra serializuojamas
    // {

    // }



}