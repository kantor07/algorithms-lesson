<?php

/**
 * Разработать и реализовать на PHP собственную ORM 
 * (Object-Relational Mapping —прослойку между базой данных 
 * и кодом) посредством абстрактной фабрики.
 * Фабрики будут реализовывать интерфейсы СУБД MySQLFactory, 
 * PostgreSQLFactory, OracleFactory. 
 * Каждая фабрика возвращает объекты, характерные
 * для конкретной СУБД. 
 * Пример компонентов:
 *  DBConnection — соединение с базой,
 *  DBRecrord — запись таблицы базы данных,
 *  DBQueryBuiler — конструктор запросов к базе. 
 * ### Должна получиться гибкая система, позволяющая 
 * динамически менять базу данных и инкапсулирующая 
 * взаимодействие с ней внутри продуктов конкретных фабрик. 
 * Углубляться в детали компонента не обязательно — достаточно 
 * их наличия.
 */

 /**
*Создаем интерфейс Абстрактной фабрики с нужным нам набором 
*методов
*/

abstract class AbstractFactoryORM
{
    abstract public function getDBConnection() : DBConnection;
    abstract public function getDBRecord() : DBRecord;
    abstract public function getDBQueryBuilder() : DBQueryBuilder;
}

/**
 * Создаем базовый интерфейс каждого компонента фабрики 
 * как я поняла, в нашем задании для каждого соединения
 */
interface DBConection
{
    public function connected();
}

interface DBRecord
{
    public function recorded();
}

interface DBQueryBuilder
{
    public function queryBuilder();
}

/**
 * Фабрика MySQLFactory возвращает объекты,
 *  характерные для данной СУБД
 */

 class MySQLFactory extends AbstractFactoryORM
 {
    public function getDBConnection() : DBConnection
    {
        return new MySQLDBConnection();
    }

    public function getDBRecord() : DBRecord
    {
        return new MySQLDBRecord();
    }

    public function getDBQueryBuilder() : DBQueryBuilder
    {
        return new MySQLDBQueryBuilder();
    }

 }

/**
 * Создадим соединение MySQL 
 * не увернена в правильности содержания функции
 */
 class MySQLDBConnection implements DBConnection
 {
    public function connected()
    {
        $link = mysqli_connect('localhost','root','19041983','db_photo_gallery');
        if (!$link) {
            die("Connection failed: " . mysqli_connect_error());
        }
        echo "Connected successfully";
    }
 }

 /**
 * Сделаем запись в таблицу базы данных MySQL
 * функция должна содержать конструктор добавления записей
 */
class MySQLDBRecord implements DBRecord
 {
    public function recorded()
    {

    }
 }

 /**
  * Создаем конструктор запросов к базе данных MySQL
  * функция должна содержать конструктор запроса
 */
class MySQLDBQueryBuilder implements DBQueryBuilder
 {
    public function queryBuilder()
    {
       
    }
 }

 /**
 * Фабрика PostgreSQLFactory возвращает объекты,
 *  характерные для данной СУБД
 */

class PostgreSQLFactory extends AbstractFactoryORM
{
   public function getDBConnection() : DBConnection
   {
       return new PostgreSQLDBConnection();
   }

   public function getDBRecord() : DBRecord
   {
       return new PostgreSQLDBRecord();
   }

   public function getDBQueryBuilder() : DBQueryBuilder
   {
       return new PostgreSQLDBQueryBuilder();
   }

}

/**
* Создадим соединение PostgreSQL 
*/
class PostgreSQLDBConnection implements DBConnection
{
   public function connected()
   {
      
   }
}

/**
* Сделаем запись в таблицу базы данных PostgreSQL
* функция должна содержать конструктор добавления записей
*/
class PostgreSQLDBRecord implements DBRecord
{
   public function recorded()
   {

   }
}

/**
 * Создаем конструктор запросов к базе данных PostgreSQL
 * функция должна содержать конструктор запроса
*/
class PostgreSQLDBQueryBuilder implements DBQueryBuilder
{
   public function queryBuilder()
   {
      
   }
}

/**
 * Фабрика OracleFactory возвращает объекты,
 *  характерные для данной СУБД
 */

class OracleFactory extends AbstractFactoryORM
{
   public function getDBConnection() : DBConnection
   {
       return new OracleDBConnection();
   }

   public function getDBRecord() : DBRecord
   {
       return new OracleDBRecord();
   }

   public function getDBQueryBuilder() : DBQueryBuilder
   {
       return new OracleDBQueryBuilder();
   }

}

/**
* Создадим соединение Oracle 
*/
class OracleDBConnection implements DBConnection
{
   public function connected()
   {

   }
}

/**
* Сделаем запись в таблицу базы данных Oracle
* функция должна содержать конструктор добавления записей
*/
class OracleDBRecord implements DBRecord
{
   public function recorded()
   {

   }
}

/**
 * Создаем конструктор запросов к базе данных Oracle
 * функция должна содержать конструктор запроса
*/
class OracleDBQueryBuilder implements DBQueryBuilder
{
   public function queryBuilder()
   {
      
   }
}

  