<?php
/**
 * Предположим, что у нас есть приложение, способное отправлять оповещения тремя способами: SMS, Email и 
 * Chrome Notification (CN). Пользователю предлагается выбрать, какие уведомления будут приходить. 
 * На каждый из вариантов необходим свой подкласс. Например: SMS + Email, Email + CN, SMS + Email + CN. Как поступить? 
 * Использовать композицию. Мы не станем наследоваться, но при этом один объект будет содержать в себе другой. 
 * Возьмём условный объект SMS и обернём его другим объектом, в котором расположится дополнительная логика. 
 * Благодаря общему интерфейсу так можно поступать несколько раз подряд.
 * В примере с оповещениями в качестве базового класса — своеобразного «нулевого пациента» — выберем вариант 
 * вовсе без оповещений. А реализации различных способов отправки станут декораторами-обёртками. 
 */

//Базовый интерфейс Компонента

    interface MailingList 
    {
	    public function mailingBody(string $someText) : string;
	}

//базовый компонент

	class MailingBase implements MailingList 
    {
	    public function mailingBody(string $someText) : string
        {
	        return 'MailingBase ' . $someText ;
	    }
	}

//Декоратор

    class MailingListDecorator implements MailingList 
    {
	    protected $mailing;

        public function __construct(MailingList $mailing) 
        {
	        $this->mailing = $mailing;
	    }

//Декоратор делегирует всю работу обёрнутому компоненту

	   public function mailingBody(string $someText) : string
       {
//        echo "mailing <br>";
        return $this->mailing->mailingBody($someText);
       }

	}

    class MailingSMSDecorator extends MailingListDecorator 
    {
	    public function mailingBody(string $someText) : string
        {
	        return "This is SMS mailing(" . parent::mailingBody($someText). ")<br>";
        //    $this->mailingList->mailingBody();
        }
	}

    class MailingEMailDecorator extends MailingListDecorator 
    {
	    public function mailingBody(string $someText) : string
        {
	        return "This is eMail mailing(" . parent::mailingBody($someText). "<br>";
        }
	}

    class MailingCNDecorator extends MailingListDecorator
    {
	    public function mailingBody(string $someText) : string
        {
            return "This is Chrome Notification (CN) mailing(" . parent::mailingBody($someText). "<br>";
        }
	}

 
//Проверка
$someText = "Text for mailing";
$simple = new MailingBase();
$decorator = new MailingSMSDecorator($simple);
$decorator1 = new MailingEMailDecorator($decorator);
$decorator2 = new MailingCNDecorator($decorator1);
$decorator3 = new MailingCNDecorator($decorator2);

echo $decorator1->mailingBody($someText);
echo $decorator2->mailingBody($someText);
echo $decorator3->mailingBody($someText);