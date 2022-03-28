<?php
/**
 * 2. Реализовать паттерн Адаптер для связи внешней библиотеки (классы SquareAreaLib и CircleAreaLib) 
 * вычисления площади квадрата (getSquareArea) и площади круга (getCircleArea) с интерфейсами ISquare и 
 * ICircle имеющегося кода. 
 * Примеры классов даны ниже. 
 * Причём во внешней библиотеке используются для расчётов формулы нахождения через диагонали фигур, 
 * а в интерфейсах квадрата и круга — формулы, принимающие значения одной стороны и длины окружности соответственно.
 */
 
//Внешняя библиотека:
class CircleAreaLib
{
    public function getCircleArea(int $diagonal)
   {
        $area = (M_PI * $diagonal**2)/4;
         $area;
         return $area;
   }
}

class SquareAreaLib
{
    public function getSquareArea(int $diagonal)
   {
        $area = ($diagonal**2)/2;
        return $area;
   }
}

//Имеющиеся интерфейсы:

interface ISquare
{
    function squareArea(int $sideSquare);
}

interface ICircle
{
    function circleArea(int $circumference);
}

//Адаптер CircleAreaLib
class CircleAdapter implements ICircle
{
    private $adaptee;

    public function __construct(CircleAreaLib $adaptee)
    {

        $this->adaptee = $adaptee;
    }

    public function circleArea(int $circumference)
    {
        $diagonal = round($circumference / M_PI);
        return $this->adaptee->getCircleArea($diagonal);
    }
}

//Адаптер SquareAreaLib
class SquareAdapter implements ISquare
{
    private $adaptee;

    public function __construct(SquareAreaLib $adaptee)
    {

        $this->adaptee = $adaptee;
    }

    public function squareArea(int $sideSquare)
    {
        $diagonal = ($sideSquare*(sqrt(2)));
//        echo $diagonal;
        return $this->adaptee->getSquareArea($diagonal);
    }
}

//проверка
$circumference = 100;
$adaptee = new CircleAreaLib();
$adapter = new CircleAdapter($adaptee);
// за счет округления получаю не 100/3.14 = 31.83; 3.14 * 31.83^2/4 = 796, а 804
echo "Если длина окружности круга равна " . $circumference . " то площадь квадрата равна " . round($adapter->circleArea($circumference)) . "<br>";    

$sideSquare = 6;                        
$adaptee = new SquareAreaLib();
$adapter = new SquareAdapter($adaptee);
//за счет округления получаю не 6**2 = 36, а 32
echo "Если одна из сторон квадрата равна " . $sideSquare . " то площадь квадрата равна " . $adapter->squareArea($sideSquare) . "<br>";