<?php
/**
 * 1. Реализовать построение и обход дерева для 
 * математического выражения.
 */

/**
 * эта функция выполняет простую очистку синтаксиса:
 *  - удаляет все пробелы
 *  - заменяет '**' на '^'
 * затем запускает регулярное выражение для разделения 
 * содержимого на токены. набор возможных токенов в этом 
 * случае предопределены числами (целые числа с плавающей запятой)
 * математические операторы (*, -, +, /, **, ^) и круглые скобки.
 */
//$content = "5 + 3 / 2";       //3 2 / 5 +
$content = "(5 + 3) / 2";       //5 3 + 2 /
tree($content);
//echo '<pre>'. print_r(tree($content)). '</pre>';

function tree($content) {
    $parenthesis;
    $leftStack = array();
    $rightStack = array();
    $stack = array();
    $tokens = array();
    $tokens = str_replace(array("\n","\r","\t"," "), '', $content);
    $tokens = str_replace('**', '^', $tokens);
    $tokens = preg_split('//', $tokens, -1, PREG_SPLIT_NO_EMPTY);
    
    echo '<pre>';
    print_r($tokens);
    echo '</pre>';

/**
 * Перебираю входное выражение и делаю следующее для 
 * каждого символа. 
 * 1) Если символ является операндом, помещаю его в основной массив 
 * 2) Если символ является оператором, извлекаю значения 
 *  и делаю их дочерними
 * В конце корнем дерева выражений будет только элемент основного массива.
*/
    foreach($tokens as $item) {                     
        switch (true) {
            case (preg_replace("/[^0-9]/", '', $item)):
                $stack[] = $item;
            break;
        
            case ($item =='*' || $item =='/'):
                $leftStack[] = array_shift($stack);
                $rightStack[]= $item;
            break;

            case ($item =='+' || $item =='-'):
                $rightStack[]= $item;    
            break;

            case ($item == "(" || $item == ")"):
                $parenthesis = true;    
            break;

            case ($item != "(" && $item != ")"):
                $parenthesis = false;    
            break;

        }
        
    }

    if ($parenthesis == true) {
        $elmStack = array_pop($stack);              //забираем последний элемент основного массива
        $elmRightStack = array_shift($rightStack);  //забираем первый элемент массива
        $stack[] = $elmRightStack;                  //добавляем в основной массив элементы
        $stack[] = $elmStack;
        $stack = array_merge($leftStack, $stack, $rightStack);//объединяем все массивы в один
    } else {
        $elmRightStack = array_shift($rightStack);
        $stack = array_merge($stack, $rightStack, $leftStack);
        $stack[] = $elmRightStack;
    }
//}

   
    


    echo "<pre>";
    print_r($stack); echo ' основная <br>';
    print_r($leftStack); echo ' левая часть<br>';
    print_r($rightStack); echo ' правая часть<br>';
    echo "</pre>";

    echo implode(' ', $stack) . " ";
}