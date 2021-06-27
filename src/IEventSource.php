<?php
namespace MessageCenter;

/**
 *
 * @author Damian Bistram <info@bistram.pl>
 * 
 */
interface IEventSource
{
    const C_DEFAULT_CHANNEL = 'CH_EventSource_Default';
    
    public function addEventListener(IEventListener $listener, string $channelName = null): IEventSource;
    public function removeEventListener(IEventListener $listener, string $channelName = null): IEventSource;
    public function dispatchEvent(IEvent $event): void;
    public function getRegisteredChannelNames(): array;
    public function isEventListenerRegistered(IEventListener $listener, string $channelName = null): bool;
}
