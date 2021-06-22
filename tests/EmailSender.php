<?php
namespace Tests\MessageCenter;

use MessageCenter\IEventListener;
use MessageCenter\IEvent;

class EmailSender implements IEventListener
{
    public function handleEvent(IEvent $event): void
    {
        echo "Handled event! I'm sending an email!";
    }
}