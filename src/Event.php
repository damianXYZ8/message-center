<?php
namespace MessageCenter;

/**
 * Description of event
 *
 * @author Damian Bistram
 */

class Event implements IEvent
{

    private $timestamp;
    private $channelName;
    private $name;
    private $data;
   
    public function __construct(string $name, string $channelName = null)
    {
        if (!isset($channelName)) {
            $channelName = IEventSource::C_DEFAULT_CHANNEL;
        }
        $this->channelName = $channelName;
        $this->timestamp =  time();
        $this->name = $name;
    }
    
    public function getChannelName(): string
    {
        return $this->channelName;
    }
    
    public function getTimeStamp(): int
    {
        return $this->timestamp;
    }
    
    public function getName(): string
    {
        return $this->name;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setData(&$data)
    {
        $this->data = $data;
    }
}
