<?php
require_once '../vendor/autoload.php';

use MessageCenter\MessageCenter;
use MessageCenter\IEventListener;
use Tests\MessageCenter\EmailSender;
use Tests\MessageCenter\EventChannels;

interface IListener
{
}

class A implements IListener
{
    protected $tab = [];

    public function add(IListener $listener): void
    {
        $this->tab[] = $listener;
        var_dump($this->tab);
    }

    public function remove(IListener $listener): int
    {
        var_dump($listener);
        var_dump($this->tab);
        if (false === ($i = array_search($listener, $this->tab, true))) {
            throw new \Exception('Nie znalazłem obiektu!!!');
        }
        return $i;
    }
}

class B implements IListener
{

}

class EmailSenderA implements IListener
{
}

class C
{
    private $emailSender;

    public function __constructor()
    {
        $this->emailSender = new EmailSenderA();
    }
}

$a = new A();
$b = new B();
$tab[] = $b;

$a->add($b);
$i = $a->remove($b);

var_dump($i);

$emailSender = new EmailSender();

$mc = MessageCenter::instance();
$mc->addEventListener($emailSender, EventChannels::CH_WORKFLOW);
$registeredChannelNames = MessageCenter::instance()->getRegisteredChannelNames();
var_dump($mc->getEventListenersFromChannel(EventChannels::CH_WORKFLOW));
MessageCenter::instance()->removeEventListener($emailSender, EventChannels::CH_WORKFLOW);
var_dump($mc->getEventListenersFromChannel(EventChannels::CH_WORKFLOW));
$registeredChannelNames = MessageCenter::instance()->getRegisteredChannelNames();


unset($mc);
var_dump($mc);
echo "****************\n";

$emailSender = new EmailSender();
$mc = MessageCenter::instance();
$mc->removeAllEventListeners();
var_dump($mc->getEventListenersFromChannel(EventChannels::CH_WORKFLOW));
$mc->addEventListener($emailSender, EventChannels::CH_WORKFLOW);
var_dump($mc->getEventListenersFromChannel(EventChannels::CH_WORKFLOW));
$mc->removeEventListener($emailSender, EventChannels::CH_WORKFLOW);
var_dump($mc->getEventListenersFromChannel(EventChannels::CH_WORKFLOW));
$registeredChannelNames = MessageCenter::instance()->getRegisteredChannelNames();
$registered = $mc->isEventListenerRegistered($emailSender, EventChannels::CH_WORKFLOW);
var_dump($registered);
var_dump($mc->getEventListenersFromChannel());

echo "Jestem!!!";
