<?php
namespace Tests\MessageCenter;

use PHPUnit\Framework\TestCase;
use MessageCenter\MessageCenter;
use MessageCenter\IEventListener;
use Tests\MessageCenter\EmailSender;
use Tests\MessageCenter\EventCHannels;

class MessageCenterTest extends TestCase 
{
    protected function setUp(): void
    {
    }

/**
 * @test
 *  */    
    public function initializeMessageCenter()
    {
        $mc = MessageCenter::instance();
        $mc->removeAllChannels();
        $this->assertEquals(0, count($mc->getRegisteredChannelNames()));
        return $mc;
    }

    /**
     * @test
     */
    public function itAddsAndChecksListenerRegistrationInChannel(): void 
    {
        $emailSender = new EmailSender();
        $mc = $this->initializeMessageCenter();
        $registered = $mc->isEventListenerRegistered($emailSender, EventChannels::CH_WORKFLOW);
        $this->assertEquals(false, $registered);
        $mc->addEventListener($emailSender, EventChannels::CH_WORKFLOW);
        $registered = $mc->isEventListenerRegistered($emailSender, EventChannels::CH_WORKFLOW);
        $this->assertEquals(true, $registered);
    }

    /**
     * @test
     */
    public function itAddsOneListenerToChannelAndChecksChannelCreation(): void
    {
        $emailSender = new EmailSender();
        $mc = $this->initializeMessageCenter();
        $mc->addEventListener($emailSender, EventChannels::CH_WORKFLOW);  
        $registeredChannelNames = $mc->getRegisteredChannelNames();
        $this->assertIsArray($registeredChannelNames);
        $this->assertContains(EventChannels::CH_WORKFLOW, $registeredChannelNames);   
    }

    /**
     * @test 
     * */    
    public function itRemovesListenerFromChannel(): void
    {      
        $emailSender = new EmailSender();
        $mc = $this->initializeMessageCenter();  
        $mc->addEventListener($emailSender, EventChannels::CH_WORKFLOW);  
        $listeners = $mc->getEventListenersFromChannel(EventChannels::CH_WORKFLOW);

        $mc->removeEventListener($emailSender, EventChannels::CH_WORKFLOW);
        $registeredChannelNames = MessageCenter::instance()->getRegisteredChannelNames();
        $this->assertIsArray($registeredChannelNames);
        $registered = $mc->isEventListenerRegistered($emailSender, EventChannels::CH_WORKFLOW);
        $this->assertEquals(false, $registered);
    }

    /**
     * @test
     */
    public function itAddsListenersToTwoChannelsAndThenRemovesAllListenersFromChannel(): void
    {
        $mc = $this->initializeMessageCenter();

        for ($i = 0; $i < 5; $i++) {
            MessageCenter::instance()->addEventListener(new EmailSender, EventChannels::CH_WORKFLOW);
        }
        for ($i = 0; $i < 9; $i++) {
            MessageCenter::instance()->addEventListener(new EmailSender, EventChannels::CH_DOCUMENT);
        }

        $chWorkflow= $mc->getEventListenersFromChannel(EventChannels::CH_WORKFLOW);
        $chDocument = $mc->getEventListenersFromChannel(EventChannels::CH_DOCUMENT);

        $this->assertEquals(5, count($chWorkflow));
        $this->assertEquals(9, count($chDocument));

        $this->assertEquals(2, count($mc->getRegisteredChannelNames()));
        $mc->removeAllChannels();
    }

/**
 * @test
 *  */    
    public function itAddsListenersToDefaultChannel()
    {
        $mc = $this->initializeMessageCenter();
        $mc->addEventListener(new EmailSender());  

        $this->assertEquals(1, count($mc->getEventListeners()));
    }

    /**
    * @test
    */
    public function itRemovesListenersFromDefaultChannel()
    {
        $mc = $this->initializeMessageCenter();
        $emailSender = new EmailSender();
        $mc->addEventListener($emailSender);
        $mc->removeEventListener($emailSender);

        $this->assertEquals(0, count($mc->getEventListeners()));
    }

}

