<?php
/*
    1. К сожалению у меня мало кода для проверки
        так как я не практикующий программист
    
    При написании формы-калькулятора с операциями 
    получила спагетти-код из кучи if и elseif
*/

//создала переменную для вывода ответа
$answer = " ";
if(isset($_POST['numberOne']) && isset($_POST['numberTwo'])) {
    $number1 = $_POST['numberOne'];
    $number2 = $_POST['numberTwo'];
    $operation = $_POST['operation'];
//проверим, чтобы не было пустых полей
    if($number1 == NULL || $number2 == NULL) {
        $error_result = 'Не все поля заполнены';
    }    
/*
    проверяем что введены числа и если ошибок нет, 
    то считаем результат
*/
    else { 
        if(!is_numeric($number1) || !is_numeric($number2)) {
            $error_result = 'Должны быть введены числа';
        }
        else {
            switch($operation) {
                case '+':
                  $result = $number1 + $number2;
                    break; 
                case '-':
                    $result = $number1 - $number2;
                    break; 
                case '*':
                    $result = $number1 * $number2;
                    break;
                case '/':
                    if($number2 == '0') {
                        $error_result = 'На ноль делить нельзя';
                    }
                    else {
                        $result = $number1 / $number2;
                        break;
                    }
            }
        }
    }    
//результат запишем в переменную $answer
    if(isset($error_result)) {
        $answer =  "Ошибка: $error_result";
    }    
    else {
       $answer = "Ответ: $result";
    }
}

//при расчете наценки вообще редкостный *овно код



function margin($price) {
    if($price < 50) {
	    return $price *= 1.3;
    }
    else if($price < 100) {
	    return $price *= 1.2;
    }
    else if($price < 200) {
	    return $price *= 1.1;
    }
    else {
        return$price *= 1.05;
    }

echo 'Стоимость товара: ', $price; // Стоимость товара: 165

}
 
echo margin(150);  // 165


//применение глобальной переменной при подключении базы данных 
//то же тогда ошибка так как ее можно переопределить
// Подключение к БД из отдельного файла
require_once 'db.php';
global $DBLink;

$result = mysqli_query($DBLink, "SELECT photo_name FROM photos");
