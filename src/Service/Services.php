<?php


namespace App\Service;


class Services
{

    public function load($file, $repertoire){

        $fileName = md5( uniqid() ).'.'.$file->guessExtension();

        $file->move($repertoire, $fileName);

        return $fileName;

    }

}