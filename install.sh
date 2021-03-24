#!/bin/bash
echo "Installing dependencies (expect and telnet)."
sudo apt update
sudo apt upgrade
sudo apt install telnet expect
echo "Installing examples to /opt/scripte/duepi-serial-interface"
mkdir /opt/scripte
mkdir /opt/scripte/duepi-serial-interface
cd /opt/scripte/duepi-serial-interface
wget https://raw.githubusercontent.com/pascaltippelt/duepi-serial-interface/main/sendData.sh -O /opt/scripte/duepi-serial-interface/sendData.sh
chmod +x /opt/scripte/duepi-serial-interface/sendData.sh
cd
echo "Installation done. You may now configure the IP and port in ""/opt/scripte/duepi-serial-interface/sendData.sh"""