<?php
/**
 * Цель задания — разобраться, в каких случаях уместно применять поведенческие 
 * паттерны, и научиться их реализовывать.
 * 
 * 1. Наблюдатель: 
 * есть сайт HandHunter.gb. На нем работники могут подыскать себе вакансию 
 * РНР-программиста. 
 * Необходимо реализовать классы искателей с их именем, почтой и стажем работы. 
 * Также реализовать возможность в любой момент встать на биржу вакансий 
 * (подписаться на уведомления), либо же, напротив, выйти из гонки за местом. 
 * Таким образом, как только появится новая вакансия программиста, все жаждущие 
 * автоматически получат уведомления на почту (можно реализовать условно).
 */

 //интерфейсы
interface SplObserver1 
{
   public function update(Vacancy $vacancy);    //получить обновление от субъекта
}


interface SplSubject1 
{
    public function attachObserver(SplObserver1 $observer);  //присоединить наблюдателя
    public function detachObserver(SplObserver1 $observer);  //отсоединить наблюдателя
    public function notifyObserver();                      //уведомить наблюдателя
}

//класс вакансии
class Vacancy
{
    private $name;
    private $content;

    public function __construct ($name, $content)
    {
        $this->name = $name;
        $this->content = $content;
    }
   
    public function getContent() 
    {
        return " <b> " . $this->name . " </b> " . $this->content;
    }

}

//класс агенства по поиску работы
class JobSearchAgency implements SplSubject1 
{
    private $name;
    private $observers;
    private $vacancy;
   
    public function __construct($name) 
    {
        $this->_observers = new SplObjectStorage();
        $this->name = $name;
    }

//присоединить наблюдателя
    public function attachObserver(SplObserver1 $observer) 
    {
        $this->_observers->attach($observer);
    }

//отсоединить наблюдателя
    public function detachObserver(SplObserver1 $observer) 
    {
        $this->_observers->detach($observer);
    }

//уведомить наблюдателя
    public function notifyObserver() 
    {
        foreach ($this->_observers as $observer) 
        {
            $observer->update($this->vacancy);
        }
    }

//создание вакансии
    public function addVacancy(Vacancy $vacancy)
    {
        $this->vacancy = $vacancy;
        $this->notifyObserver();
    }   
}

//класс соискателя
class Candidate implements  SplObserver1
{
    private $name;
    private $mail;
    private $experience;
       
    public function __construct($name, $mail, $experience) 
    {
        $this->name = $name;
        $this->mail = $mail;
        $this->experience = $experience;
    }

    public function update(Vacancy $vacancy)
    {
        echo $this->name.', появилась новая вакансия ' . $vacancy->getContent() . '</b><br>';
    }
}

//создаем агенство
$HH = new JobSearchAgency('HH');

//создадим нового соискателя
$Ivan = new Candidate('Иван', 'Iva@mail.ru', 'Web-разработчик более 5 лет');
$HH->attachObserver($Ivan);

$Ignat = new Candidate('Игнат', 'Iga@mail.ru', 'PHP-разработчик более 3 лет');
$HH->attachObserver($Ignat);

//создадим новую вакасию
$vacancy = new Vacancy('Программист','Требуется web-разрабочик, З/п 1000');

//публикуем вакансию на сайте
$HH->addVacancy($vacancy);

//удаляем соискателя
$HH->detachObserver($Ivan);

//создадим новую вакасию
$vacancy1 = new Vacancy('Программист','Требуется php-разрабочик, З/п 2000');

//публикуем вакансию на сайте
$HH->addVacancy($vacancy1);