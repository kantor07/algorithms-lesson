<?php
/**
 * Создать массив на миллион (достаточно 10 000) элементов 
 * и отсортировать его различными способами.
 * Сравнить скорости.
 */

$array = range(1, 100);         //Создаёт массив, содержащий диапазон элементов
shuffle($array);                  //Перемешивает массив

//echo '<pre>'. print_r($array, true). '</pre>';

//sort — Сортирует массив по возрастанию

$start_time = microtime(true);

function sortArray($array) {
    sort($array);
    return $array;
}
//echo '<pre>' . print_r(sortArray($array),true) . '</pre>';    
sortArray($array);

$end_time = microtime(true);

echo '<br> Скорость sort сортировки '
      . $end_time-$start_time . '<br>';

//rsort — Сортирует массив по убыванию

$start_time = microtime(true);
      
function rsortArray($array) {
    rsort($array);
    return $array;
}
//echo '<pre>' . print_r(rsortArray($array),true) . '</pre>';     
rsortArray($array);
      
$end_time = microtime(true);
      
echo '<br> Скорость rsort сортировки '
    . $end_time-$start_time . '<br>';

//Быстрая сортировка
$start_time = microtime(true);

function quickSort($array) {
    if (count($array) <= 1) {                   
       return $array;                         
    }
 
    $first_val = $array[0];
    $left_arr = array();
    $right_arr = array();
 
    for ($i = 1; $i < count($array); $i++) {       //перебираем массив
        if ($array[$i] <= $first_val) {            //если текущий элемент меньше или равен 0 элементу массива
            $left_arr[] = $array[$i];              //то относим его к левой стороне массива
        } else {
            $right_arr[] = $array[$i];             //иначе к правой стороне массива
        }
    }
 
    $left_arr = quickSort($left_arr);              //сортируем левую сторону массива
    $right_arr = quickSort($right_arr);            //сортируем правую сторону массива
 
    return array_merge($left_arr, array($first_val), $right_arr);           //Сливает левый и правый массив в один массив
}
//echo '<pre>' . print_r(quickSort($array),true) . '</pre>';  
quickSort($array);

$end_time = microtime(true);
echo '<br> Скорость быстрой сортировки '
      . $end_time-$start_time . '<br>';
      
/**
 * Сортировка вставками (англ. Insertion sort) — алгоритм 
 * сортировки, в котором элементы входной последовательности 
 * просматриваются по одному, и каждый новый поступивший 
 * элемент размещается в подходящее место среди ранее 
 * упорядоченных элементов
 */

$end_time = microtime(true);

function insertSort($array) {
    if (count($array) <= 1) {
        return $array;
    }
 
    for ($i = 1; $i < count($array); $i++) {
        $cur_val = $array[$i];
        $j = $i - 1;
 
        while (isset($array[$j]) && $array[$j] > $cur_val) {
            $array[$j + 1] = $array[$j];
            $array[$j] = $cur_val;
            $j--;
        }
    }
 
    return $array;
}

//echo '<pre>' . print_r(insertSort($array),true) . '</pre>';  
insertSort($array);

$end_time = microtime(true);
      
echo '<br> Скорость insertSort сортировки '
    . $end_time-$start_time . '<br>';

//Пузырьковая сортировка
$start_time = microtime(true);

function bubleSort($array) {
    for ($i = 0; $i < count($array); $i++){             // перебираем массив
        for ($j=$i+1; $j < count($array);$j++){
                if ($array[$i] > $array[$j]){           // если текущий элемент больше следующего
                $tmp = $array[$j];                      // меняем местами элементы
                $array[$j] = $array[$i];
                $array[$i] = $tmp;
            }
        }
    }
    return $array;
}
//echo '<pre>' . print_r(bubleSort($array),true) . '</pre>';
bubleSort($array);

$end_time = microtime(true);
echo '<br> Скорость пузырьковой сортировки '
      . $end_time-$start_time . '<br>';

//Шейкерная сортировка
$start_time = microtime(true);

function shakerSort($array) {
    $n = count($array);
    $left = 0;
    $right = $n - 1;
    do {
        for ($i = $left; $i < $right; $i++) {
            if ($array[$i] > $array[$i + 1]) {
                list($array[$i], $array[$i + 1]) = array($array[$i + 1],
                $array[$i]);
            }
        }
        $right -= 1;
            for ($i = $right; $i > $left; $i--) {
                if ($array[$i] < $array[$i - 1]) {
                    list($array[$i], $array[$i - 1]) = array($array[$i - 1],
                    $array[$i]);
                }
            }
        $left += 1;
    } while ($left <= $right);
    return $array;
}
//echo '<pre>' . print_r(shakerSort($array),true) . '</pre>';  
shakerSort($array);

$end_time = microtime(true);
echo '<br> Скорость шейкерной сортировки '
      . $end_time-$start_time . '<br>';


