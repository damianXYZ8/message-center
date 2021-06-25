# message-center
[![Build Status](https://github.com/damianXYZ8/message-center/workflows/Continuous%20Integration/badge.svg)](https://github.com/damianXYZ8/message-center/actions)

MessageCenter is a simple mechanism that provides a simple event system.
Events are sent throughout channels and senders and listeners are decoupled.
An EventSender register its channel in MessageCenter an pushes events to this channel.
EventListeners register themselves to the channel and get events from it. 

