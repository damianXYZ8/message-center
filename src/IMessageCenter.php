<?php
namespace MessageCenter;

/**
 *
 * @author Damian Bistram;
 */

 use MessageCenter\IEventListener;
 use MessageCenter\IEventSource;

interface IMessageCenter extends IEventListener, IEventSource
{
}
