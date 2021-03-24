# duepi-serial-interface
Descibes the serial interface of pellet stoves based on the Duepi Evo line

# WARNING

This code comes "as is" without any guarantee for function, functional safety or completeness. Use is entirely at your own risk. Incorrect operation could kill you and your cat.

# general information

This code was reverse-engineeres by @aceindy and me. We used [Wireshark](https://www.wireshark.org/) to grab the transported commands and interpreted them.

# hardware interface

You will need to connect to the serial interface on the Duepi Mainboard. Mostly the interface is accessible on the back of the stove by a 4-pin connector. In my case it was a "ATX 4-Pin CPU Connector".

The serial interface is 5 V TTL. So you might just connect a TTL FTDI to USB adapter to this and your PC. If you want to connect a ESP or Arduino you have to remember, that some devices like the ESP-01s only support 3.3 V logic, so you might use a logic level shifter.

Use a baudrate of 115200, 8N1