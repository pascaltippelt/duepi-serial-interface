# duepi-serial-interface
Descibes the serial interface of pellet stoves based on the Duepi Evo line. It is known to be working with the "Wamsler Quattro 6" pelletstove.

# WARNING

This code comes "as is" without any guarantee for function, functional safety or completeness. Use is entirely at your own risk. Incorrect operation could kill you and your cat.

# General information

This code was reverse-engineeres by @aceindy and me. We used [Wireshark](https://www.wireshark.org/) to grab the transported commands and interpreted them.

# Hardware interface

You will need to connect to the serial interface on the Duepi Mainboard. Mostly the interface is accessible on the back of the stove by a 4-pin connector. In my case it was a "ATX 4-Pin CPU Connector".

The serial interface is 5 V TTL. So you might just connect a TTL FTDI to USB adapter to this and your PC. If you want to connect a ESP or Arduino you have to remember, that some devices like the ESP-01s only support 3.3 V logic, so you might use a logic level shifter.

Use a baudrate of 115200, 8N1

*For all my examples I use a ESP-01s in the WiFi with a telnet-server, so I can remotely communicate with my stove.*

# General usage

## Installation

The install script is supposed to be used with Debian / Ubuntu based systems, but the bash scripts can run on any system that can install the dependencies (expect and telent).

To install just run:

```bash
curl -s https://git.io/JYfPd | bash -s --
```

## Usage

Just run ./sendData.sh [command] as shown in the example:

```bash
./sendData.sh RD90005F
```

This will return the status code in the console. To write the status to a file type:

```bash
./sendData.sh RD90005F > status.txt
```

Warning! the status code in the commandline is not fully visible, but stdio forwards it correctly including all steering codes. Commandline only shows "2010023&" of full return "^[02010023&"!!!

## Commands

A full list of known commands and responses is located in [commands.txt](https://raw.githubusercontent.com/pascaltippelt/duepi-serial-interface/main/commands.txt).

# Examples

## Apache + PHP

Install apache2 + php . Then download the files in examples/php . Open a webbrowser an navigate to the webservers ip. Now you can steer the pelletstove via webinterface.

![example web gui](https://raw.githubusercontent.com/pascaltippelt/duepi-serial-interface/main/examples/php/example-image.PNG "nope")