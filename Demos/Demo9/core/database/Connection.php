<?php

namespace Core\Database;

use Exception;

class Connection
{
    private $dir;
    private $files;

    public static function make($config)
    {
        $connection = new static;
        $connection->dir = __DIR__ . "/../../{$config['directory']}";
        
        $files = scandir($connection->dir);

        foreach($files AS $file)
        {
            $pathinfo = pathinfo($connection->dir . '/' . $file);
          
            if(is_file($connection->dir . '/' . $file) && $pathinfo['extension'] === 'json')
            {
                $connection->files[ $pathinfo['filename'] ] = $pathinfo;
            }
        }

        return $connection;

    }

    public function get($filename)
    {

        try
        {
            
            if(array_key_exists($filename,$this->files))
            {
                $file = $this->files[$filename];

                return json_decode(file_get_contents($file['dirname'] . '/' . $file['basename']),true);
            }

            throw new Exception("No file defined for the filename: {$filename}.");

        } 
        catch(Exception $exception)
        {
            echo $exception->getMessage();
        }
        
    }

}