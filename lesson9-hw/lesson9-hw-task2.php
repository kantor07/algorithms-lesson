<?php
/**
 * Реализовать удаление элемента массива по его значению. 
 * Обратите внимание на возможные дубликаты! 
 */

//Создаёт массив, содержащий диапазон элементов
$array = range(0, 10); 

echo 'Изначальный массив <pre>'. print_r($array, true). '</pre>';

//$num = 95320;
$num = 7;
$num1= 10;

//Бинарный поиск и удаление элемента массива
function unsetElmArrayBinarySearch ($array, $num) {
//определяем границы массива
    $left = 0;
    $right = count($array) - 1;
    while ($left <= $right) {
//находим центральный элемент с округлением индекса в меньшую сторону
        $middle = floor(($right + $left)/2);
//если центральный элемент и есть искомый
        if ($array[$middle] == $num) {
            unset($array[$num]);
            echo $num . " удален из массива" . '<br>';
            echo 'Массив с удаленным значением<pre>'.print_r($array, true).'</pre>';
        } elseif ($array[$middle] > $num) {
//сдвигаем границы массива до диапазона от left до middle-1
            $right = $middle - 1;
        } else {
            $left = $middle + 1;
        }
    }
        return null;
}
    
if (unsetElmArrayBinarySearch( $array , $num ) == false) {
        echo $num . " в массиве отсутсвует <br>" ;
}

/**
 * array_search — Осуществляет поиск данного значения в массиве 
 * и возвращает ключ первого найденного элемента в случае 
 * успешного выполнения
 */
$key = array_search($num1, $array);
if ($key !== false)
{
	unset($array[$key]);
    echo '<br>' . $num1 . " удален из массива" . '<br>';
    echo 'Массив с удаленным значением<pre>'.print_r($array, true).'</pre>';
}