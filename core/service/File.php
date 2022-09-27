<?php

namespace app\core\service;

class File {

    public static function readCSV($file){
        if(!$file){
            throw new \yii\base\InvalidArgumentException("Invalid file");
        }
        $data = [];
        $handler = fopen($file,'r');
        if($handler){
            while ($line = fgetcsv($handler)){
                $data[] = $line;
            }
        }
        fclose($handler);
        return $data;
    }
}
