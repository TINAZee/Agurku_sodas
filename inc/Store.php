<?php
namespace TINAZee;

class Store {

    private const PATH = DIR.'/data/';

    private $fileName = 'sodas';
    private $data;

    public function __construct($file)
    {
        $this->fileName = $file;
        if (!file_exists(self::PATH.$this->fileName.'.json')) {
            file_put_contents(self::PATH.$this->fileName.'.json', json_encode(['obj' => [],'obj1' => [], 'ID' => 0])); // pradinis masyvas
            $this->data = ['obj' => [],'obj1' => [], 'agurku ID' => 0];
        }
        else {
            $this->data = file_get_contents(self::PATH.$this->fileName.'.json'); // nuskaitom faila
            $this->data = json_decode($this->data, 1); // paverciam masyvu
        }
    }

    public function __destruct()
    {
        file_put_contents(self::PATH.$this->fileName.'.json', json_encode($this->data)); // viska vel uzsaugom faile
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData($data)
    {
        $this->data = $data;
    }

    public function getNewId()
    {
        $id = $this->data['ID'];
        $this->data['ID']++;
        return $id;
    }

    public function addNew(Agurkas $obj)
    {
        $this->data['obj'][] = serialize($obj);
    }

    // public function addNew(Zirniai $obj1)
    // {
    //     $this->data['obj1'][] = serialize($obj);
    // }

    public function getAll()
    {
        $all = [];
        foreach($this->data['obj'] as $obj) {
            $all[] = unserialize($obj);
        }
        return $all;
    }


    public function remove($id)
    {
        foreach($this->data['obj'] as $index => $obj) {
            $obj = unserialize($obj);
            if ($obj->id == $id) {
                unset($this->data['obj'][$index]);
            }
        }
    }


}