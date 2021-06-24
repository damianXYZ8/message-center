<?php
/**
 * 
 */
require_once './vendor/autoload.php';

use ExampleApp\{UserManager, User, EventChannels};
use ExampleApp\Listeners\{ConsoleEcho, EmailSender};
use MessageCenter\{MessageCenter};

// adding MessageCenter as a listener for UserManager events
// UserManager sends events to channel named EventChannels::CH_ADMIN
$userManager = new UserManager(MessageCenter::instance(), EventChannels::CH_ADMIN);

// event listeners 
$consoleEcho = new ConsoleEcho();
$emailSender = new EmailSender();
// adding EchoConsole and EmailSender as listeners for EventChannels::CH_ADMIN events
// UserManager does not know who handles its events...
// event sources and event listeners are decoupled 
MessageCenter::instance()->addEventListener($consoleEcho, EventChannels::CH_ADMIN)
                         ->addEventListener($emailSender, EventChannels::CH_ADMIN);

$user = new User('Alex', 'Bradley', 'alexbradley@sample.com');

// adding the User lauches an event that is send to MessageCenter
// Then MassageCenter pushes the event to MessageCenter registered on CH_ADMIN channel, listeners
// i.e. ConsoleEcho and EmailSender 
$userManager->add($user);

// as an adding function, remove launches an event that is send to MessageCenter
// Then MessageCenter pushes the event to MessageCenter registered, on CH_ADMIN channel, listeners
// i.e. ConsoleEcho and EmailSender
$userManager->remove($user);

