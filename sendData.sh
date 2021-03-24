#!/usr/bin/expect
#this script connects to a telnet server (pellet stove) and executes a command. The answere is written to stdio

#get Data from first argument
set data [lindex $argv 0];
#turn off verbosity
log_user 0
#set timeout for expect
set timeout 2
#connect to telnet
spawn telnet 192.168.178.35
#wait for reply "echo ist aus"
expect "'.\r\n" { send "\x1b$data&\r" }
#wait for "&" at the end of the answere and exit telnet connection
expect "\x26" { }
log_user 1
expect "\x26" { send "\x1d" }
#turn off verbosity
log_user 0
#exit telnet
expect "telnet>" { send "quit" }
#break...
puts "\r"
#exit expect
close
exit