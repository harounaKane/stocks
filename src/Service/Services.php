<?php


namespace App\Service;


class Services
{

    public function load($file, $repertoire){
                   //pour former un nom uniq.
        $fileName = md5( uniqid() ).'.'.$file->guessExtension();

        $file->move($repertoire, $fileName);

        return $fileName;

    }

}