<?php
/**
 * Подсчитать практически количество шагов при поиске 
 * описанными в методичке алгоритмами. 
 * (ЛИНЕЙНЫЙ, БИНАРНЫЙ, ИНТЕРПОЛЯЦИОННЫЙ).
 */

//Создаёт массив, содержащий диапазон элементов
$array = range(0, 10000); 

//echo '<pre>'. print_r($array, true). '</pre>';

//$num = 95320;
$num = 9532;

//Линейный поиск
function linearSearch ($array, $num) {
    $count = 1;
    foreach($array as $arr_alm) {
        echo '<br> Линейный поиск '. $count++ . ' шаг при поиске числа ' . $num . '<br>';
        if ($arr_alm === $num) {
            return true;
        }
    }
    return false;
}

if (linearSearch( $array , $num ) == false) {
    echo $num . " в массиве отсутсвует" ;
}


//Бинарный поиск
function binarySearch ($array, $num) {
//определяем границы массива
    $count = 1;
    $left = 0;
    $right = count($array) - 1;
    while ($left <= $right) {
        echo '<br> Бинарный поиск '. $count++ . ' шаг при поиске числа ' . $num . '<br>';    
//находим центральный элемент с округлением индекса в меньшую сторону
        $middle = floor(($right + $left)/2);
//если центральный элемент и есть искомый
        if ($array[$middle] == $num) {
            return $middle;
        } elseif ($array[$middle] > $num) {
//сдвигаем границы массива до диапазона от left до middle-1
            $right = $middle - 1;
        } else {
            $left = $middle + 1;
        }
    }
    return null;
}

if (binarySearch( $array , $num ) == false) {
    echo $num . " в массиве отсутсвует" ;
}

//Интерполяционный поиск
//Алгоритм интерполяционного поиска пытается улучшить бинарный поиск!
function InterpolationSearch($array, $num)  //массив должен быть отсортирован
{
    $count = 1;
    $left = 0;                             //левая сторона поиска (предположим, что элементы массива нумеруются с нуля)
    $right = count($array) - 1;            //правая граница поиска
    while (($array[$left] < $num) && ($num < $array[$right])) {
        echo '<br> Интерполяционный поиск '. $count++ . ' шаг при поиске числа ' . $num . '<br>';
        $mid = $left + ($num - $array[$left]) * ($right - $left) / ($array[$right] - $array[$left]);   //индекс элемена, с которым будем проводить сравнение
        if ($array[$mid] < $num) {
            $left = $mid + 1;
        } elseif ($array[$mid] > $num) {
            $right = $mid - 1;
        } else {
            return $mid;
        }

        if ($array[$left] == $num) {
            return $left;
        } elseif ($array[$right] == $num) {
            return $right;
        } else {
            return -1;                     //если такого элемента нет
        }
    }
}
if (InterpolationSearch( $array , $num ) == false) {
    echo '<br>' . $num . " в массиве отсутсвует" ;
}