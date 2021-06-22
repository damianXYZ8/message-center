<?php
namespace MessageCenter;

/**
 *
 * @author Damian Bistram
 */
interface IEventSource
{
    public function addEventListener(IEventListener $listener, string $channelName = null): void;
    public function removeEventListener(IEventListener $listener, string $channelName = null): void;
    public function dispatchEvent(IEvent $event): void;
    public function getRegisteredChannelNames(): array;
    public function isEventListenerRegistered(IEventListener $listener, string $channelName = null): bool;
}
