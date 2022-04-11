<?php
/**
 * 1. Написать аналог «Проводника» в Windows для директорий 
 *    на сервере при помощи итераторов.
 */
//""
//Название какое нибудь для функции, которая содержит создание нового объекта DirectoryIterator
function listingDirectory($directory) 
{
    $dir = new DirectoryIterator($directory);
    foreach ($dir as $file) {                 //проходим циклом по содержанию директории
        if ($file->isFile()){                 //определяем является ли текущий элемент файлом
            echo $file->getFilename() . '<br>'; //имя файла текущего элемента
        } elseif(!$file->isDot()) {             //определяем является ли текущий элемент дирекорией
            echo $file->getFilename() .  '<br>';    
            listingDirectory($directory.'/'.$file);  //открываем директорию 
        }
    }                        
}

listingDirectory('../lesson8-hw/bookShopTest');

