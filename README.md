# php-network-utils
Basic network utils written in PHP.

## Features
* traceroute (IPv4 & IPv6)
* ping (IPv4 & IPv6)
* View OS routing table

## Requirements
A webserver, PHP, and Linux.

Tested on Debian 11 (bullseye) with PHP 7.4.33

The file named `net-utils-vuln.php` is an example that is vulnerable and should **not** be used.

It does not escape shell characters, so you can enter things such as `localhost; cat /etc/passwd` in the IP address field.
