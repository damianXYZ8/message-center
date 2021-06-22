<?php
namespace MessageCenter;

/**
 *
 * @author Damian Bistram
 */
interface IEventListener
{
    public function handleEvent(IEvent $event): void;
}
