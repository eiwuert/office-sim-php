<?php

namespace App\Includes;

interface DataInterface
{
    public function getData($name);
    public function getAll();
}

class JsonData implements DataInterface
{
    private $data;

    public function __construct(Array $files)
    {

        if(empty($files))
            return;

        foreach($files AS $key => $file)
        {

            $full = '/' . trim($file['dir'],'/') . '/' . $file['name'];

            if(!file_exists($full))
                continue;

            $this->data[$key] = json_decode(file_get_contents($full),true);
            
        }
        
    }

    public function getData($name)
    {
        if(!isset($this->data[$name]) || empty($this->data[$name]))
            return false;
        
        return $this->data[$name];
    }

    public function getAll()
    {
        return $this->data;
    }

}
