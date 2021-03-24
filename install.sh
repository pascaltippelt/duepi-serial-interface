#!/bin/bash
echo "Installing dependencies."
sudo apt update
sudo apt upgrade
sudo apt install telnet expect
echo "Installing examples to /opt/scripte/duepi-serial-interface"
mkdir /opt/scripte
mkdir /opt/scripte/duepi-serial-interface
cd /opt/scripte/duepi-serial-interface
wget 