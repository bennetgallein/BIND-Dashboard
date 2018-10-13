# BIND Dashboard
> A dashboard to manage DNS Entries on a BIND9 Server

[![Total Downloads](https://poser.pugx.org/bennetgallein/bind-dashboard/downloads?format=flat)](https://packagist.org/packages/bennetgallein/bind-dashboard)
[![License](https://poser.pugx.org/bennetgallein/bind-dashboard/license)](https://packagist.org/packages/bennetgallein/bind-dashboard)

![](header.png)

This Panel offers a User-Based Panel to manage DNS-Entrys for Domains on your own Nameservers.

## Requirements:
1. A Server with BIND9 Installed
2. A Server with [BIND-PythonAPI](https://github.com/bennetgallein/BIND-PythonAPI) installed (can be on the same server as BIND)


## Installation

Linux:

Navigate into the Folder you want the Panel to be installed in

```sh
git clone https://github.com/bennetgallein/BIND-Dashboard .
composer install
```
Visit the Website in your Browser and follow the Instructions ont the Website.

## Usage example

As a Hoster-Panel: Use the Database to insert Users when the Register on your Panel and the API to assign them Domains.

## Meta

Your Name – [@bennetgallein](https://twitter.com/bennetgallein) – bennet@intranetproject.net

Distributed under the GLP3.0 license. See ``LICENSE`` for more information.

[https://github.com/yourname/github-link](https://github.com/dbader/)

## Contributing

1. Fork it (<https://github.com/bennetgallein/BIND-Dashboard/fork>)
2. Create your feature branch (`git checkout -b feature/fooBar`)
3. Commit your changes (`git commit -am 'Add some fooBar'`)
4. Push to the branch (`git push origin feature/fooBar`)
5. Create a new Pull Request
