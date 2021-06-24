<?php
namespace ExampleApp\Listeners;

use MessageCenter\{IEventListener, IEvent};
use ExampleApp\{EventChannels};


class EmailSender implements IEventListener
{
    public function handleEvent(IEvent $event): void
    {
// for phpUnit testing purpose
        if (0 === \strcasecmp(EventChannels::CH_USER_MANAGER, $event->getChannelName())) {
            echo __CLASS__." I've handled event named: ".$event->getName()."\n";
            return;
        } 

        echo '****** '.__CLASS__." ******\nI've handled event named: ".$event->getName()."!\n\n";
        echo "It's time to send en email!\n\n";
        echo "Dumped event object: \n\n";
        var_dump($event);
        echo "\n\n";
    }
}