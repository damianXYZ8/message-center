<?php
namespace MessageCenter;

/**
 *
 * @author Damian Bistram <info@bistram.pl>
 */
interface IEventListener
{
    public function handleEvent(IEvent $event): void;
}
