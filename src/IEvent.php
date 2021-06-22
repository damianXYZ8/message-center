<?php
namespace MessageCenter;

/**
 *
 * @author Damian Bistram
 */

interface IEvent
{
    public function getName(): string;
    public function getChannelName(): string;
    public function getTimeStamp(): int;
    public function getData();
    public function setData(&$data);
}
