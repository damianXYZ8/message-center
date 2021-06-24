<?php
namespace ExampleApp;

use MessageCenter\{EventSource, MessageCenter, Event};
use ExampleApp\EventChannels;


class UserManager extends EventSource {

    const EV_ADD_USER = 'evAddUser';
    const EV_REMOVE_USER = 'evRemoveUser';

    protected $messageCenter = null;
    protected $channelName = null;

    public function __construct(MessageCenter $messageCenter = null, string $channelName = null)
    {
        if (false === isset($messageCenter)) return;

        $this->messageCenter = $messageCenter;
        $this->channelName = $channelName;
        $this->addEventListener($this->messageCenter, $this->channelName);
    }

    public function add(IUser $user): void
    {
// TODO: add user  

        if (false === isset($this->messageCenter)) {
            echo 'NULL MessageCenter!!!';
            return;
        }
        $event = new Event(self::EV_ADD_USER, $this->channelName);
        $event->setData($user);
        $this->dispatchEvent($event);
    }

    public function remove(IUser $user): void
    {
// TODO: remove user

        if (false === isset($this->messageCenter)) return;

        $event = new Event(self::EV_REMOVE_USER, $this->channelName);
        $event->setData($user);
        $this->dispatchEvent($event);
    }
}