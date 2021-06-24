<?php
namespace MessageCenter;

/**
 * Description of MessageCenter
 *
 * @author Damian Bistram
 */

class MessageCenter implements IMessageCenter
{
    private $eventSource;

    use \Utils\Singleton;
   
    protected function __construct()
    {
        $this->eventSource = new EventSource();
    }
    
    public function handleEvent(IEvent $event): void
    {
        $this->dispatchEvent($event);
    }

    public function addEventListener(IEventListener $listener, string $channelName = null): IEventSource
    {
        return $this->eventSource->addEventListener($listener, $channelName);
    }
    
    public function removeEventListener(IEventListener $listener, string $channelName = null): IEventSource
    {
        return $this->eventSource->removeEventListener($listener, $channelName);
    }
    
    public function dispatchEvent(IEvent $event): void
    {
        $this->eventSource->dispatchEvent($event);
    }
    
    public function getRegisteredChannelNames(): array
    {
        return $this->eventSource->getRegisteredChannelNames();
    }

    public function isEventListenerRegistered(IEventListener $listener, string $channelName = null): bool
    {
        return $this->eventSource->isEventListenerRegistered($listener, $channelName);
    }

    public function getEventListenersFromChannel(string $channelName = null): array
    {
        return $this->eventSource->getEventListenersFromChannel($channelName);
    }

    public function removeAllChannels(): void
    {
        $this->eventSource->removeAllChannels();
    }

    public function getEventListeners(): array
    {
        return $this->eventSource->getEventListeners();
    }
}
