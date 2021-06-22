<?php
namespace MessageCenter;

/**
 * Description of EventSource
 *
 * @author Damian Bistram
 */
    
use MessageCenter\IEventSource;

class EventSource implements IEventSource
{
    const C_DEFAULT_CHANNEL = 'CH_EventSource_Default';
/**
 * Variable for event listeners. It is build as two dimentional array.
 * Array keys are channel names and array items values are arrays with lists of listeners for that channel
 * @var IEventListener array of arrays
 */
    protected $listeners = [];

    public function __construct()
    {
    }

    public function addEventListener(IEventListener $listener, string $channelName = null): void
    {
        if (!isset($channelName)) {
            $channelName = self::C_DEFAULT_CHANNEL;
        }
        $this->validateListenerRegistration($listener, $channelName);
        $this->listeners[$channelName][] = $listener;
    }
    
    public function removeEventListener(IEventListener $listener, string $channelName = null): void
    {
        if (!isset($channelName)) {
            $channelName = self::C_DEFAULT_CHANNEL;
        }    
        if (false === $this->isEventListenerRegistered($listener, $channelName)) {
            throw new \Exception('Listener is not registered in ChannelName: '.$channelName);
        }
            
        if (false === ($i = array_search($listener, $this->listeners[$channelName], true))) {
            throw new \Exception('Cannot find an event listener for channelName: '.$channelName);
        }

        array_splice($this->listeners[$channelName], $i, 1);
    }
    
    public function dispatchEvent(IEvent $event): void
    {
        if (false !== array_key_exists($event->getChannelName(), $this->listeners)) {
            foreach ($this->listeners[$event->getChannelName()] as $key => $listener) {
                $listener->handleEvent($event);
            }
        }
    }

    public function isEventListenerRegistered(IEventListener $listener, string $channelName = null): bool
    {
        if (!isset($channelName)) {
            $channelName = self::C_DEFAULT_CHANNEL;
        }

// $key is channel name
// $val is an array with registered listeners for that channel
        $ret = false;
        foreach ($this->listeners as $key => $val) {
            if ((0 === strcasecmp($channelName, $key)) && in_array($listener, $val, true)) {
                $ret = true;
                break;
            }
        }
        return $ret;
    }

    protected function getChannelNamePosition(string $channelName): int
    {
        $i = -1;
        foreach ($this->listeners as $key => $val) {
            if (0 === strcasecmp($channelName, $key)) {
                $ret = $i;
                break;
            }
        }

        return $i;
    }

    protected function validateListenerRegistration(IEventListener $listener, string $channelName): void
    {
        if ($this->isEventListenerRegistered($listener, $channelName)) {
            throw new \Exception('This event listener is already registered for eventType: '.$channelName.'.');
        }
    }

    public function getRegisteredChannelNames(): array
    {
        return array_keys($this->listeners);
    }

    public function removeEventChannelAndItsListeners(string $channelName)
    {
        if ($this->isDefaultChannelName($channelName)) {
            throw new \Exception('Cannot remove default channel!');
        }

        if (false === ($ch = array_search($channelName, $this->listeners, true))) {
            throw new \Exception('ChannelName: '.$channelName.' is not registered in MessageCenter!');
        }

        $pos = $this->getChannelNamePosition($channelName);
        array_splice($this->listeners, $pos, 1);
    }

    public function removeEventListeners()
    {
        if (\key_exists(self::C_DEFAULT_CHANNEL, $this->listeners)) {
            $this->listeners[self::C_DEFAULT_CHANNEL] = [];
        }
    }

    public function getEventListenersFromChannel(string $channelName = null): array
    {
        if (!isset($channelName)) {
            return $this->listeners[self::C_DEFAULT_CHANNEL];
        }

        if (!\key_exists($channelName, $this->listeners)) {
            throw new \Exception('ChannelName: '.$channelName.' does not exist!');
        }

        return $this->listeners[$channelName];
    }

    public function getEventListeners(): array
    {
        if (!\key_exists(self::C_DEFAULT_CHANNEL, $this->listeners)) {
            $this->listeners[self::C_DEFAULT_CHANNEL] = [];
        }
        return $this->listeners[self::C_DEFAULT_CHANNEL];
    }

    public function removeAllChannels(): void
    {
        $this->listeners = [];
    }

    protected function isDefaultChannelName(string $channelName): bool
    {
        return (0 === \strcasecmp(self::C_DEFAULT_CHANNEL, $channelName));
    }
}
