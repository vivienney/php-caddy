# PHP Caddy

## Introduction
PHP Caddy is a **tiny** PHP development environment for Windows, inspired by Laravel Valet.

**No hosts file, no configuration, no frills.  Just run it and go write some code.**

PHP Caddy is basically a stripped down Valet: no *.dev domain proxy (only localhost), no linking multiple sites or
parked directories, and no sharing over local tunnels.  It also doesn't require elevated privileges to run
like some of the other Windows alternatives, which can make things easier for people in corporate environments.

Built with [Caddy](https://caddyserver.com/) web server, PHP Caddy also includes [Mailhog](https://github.com/mailhog/MailHog) 
for catching email sent by your application.

This package is for minimalists.  It does not have the full feature set of Valet, and it doesn't provide the
robust features of a virtualized environment like Homestead.
- If you are on macOS you should probably just use [Laravel Valet](https://laravel.com/docs/5.4/valet) because it's awesome.  
- If you want something more Valet-like for Windows, check out [valet-windows](https://github.com/cretueusebiu/valet-windows).
- If you want a fully virtualized Linux development environment, use [Laravel Homestead](https://laravel.com/docs/5.4/homestead).
- If you're on Windows and you want a fast, easy to use local development environment with minimal resource consumption, read on!

## Requirements
- [PHP (7.1 recommended)](http://windows.php.net/) (installed in C:\php and configured for Laravel)
- [Composer](https://getcomposer.org/)
- A database, if you need one (MySql/Mariadb/Sqlite)

### 502 Bad Gateway
There seems to be an issue with long-running php-cgi.exe processes in PHP 7.0 and earlier on Windows.  The process randomly crashes after a period of time, causing a `502 Bad Gateway` in PHP Caddy.

PHP 7.1 introduced the ability to run multiple php-cgi.exe processes, which seems to alleviate this problem.

If you are getting frequent `502 Bad Gateway` errors, try upgrading to PHP 7.1 and make sure you're running the latest
PHP Caddy by running `composer global update`.

If you can't upgrade PHP, then you can restart PHP when this happens using `caddy service php restart`.

## Installation instructions
```
composer global require samojled/php-caddy
```

## Usage
Make sure your global composer vendor/bin folder is in your system path.

### Start it up
```
cd {your php project directory}
caddy start
```

- Current directory will be linked 
- Site: http://localhost
- Mailhog: http://localhost:8025
- SMTP: 127.0.0.1:1025

### Shut it down
```
caddy stop
```

### Switch directories (serve a different project)
```
cd {another php project}
caddy link
```

### Control individual services
```
# Mailhog
caddy service mailhog start
caddy service mailhog stop
caddy service mailhog restart

# Http (Caddy)
caddy service http start
caddy service http stop
caddy service http restart

# PHP
caddy service php start
caddy service php stop
caddy service php restart
```

### Available Commands

| Command | Description |
| --- | --- |
| `caddy install` | Install PHP Caddy services |
| `caddy link` | Link Caddy to the current directory |
| `caddy start` | Start the Caddy services and Link the current directory. |
| `caddy start --without-mailhog` | For a slightly lighter resource footprint |
| `caddy stop` | Stop the Caddy services |
| `caddy which` | Determine which Valet driver serves the current working directory |
| `caddy uninstall` | Remove PHP Caddy services |
| `caddy service [service] [command]` | Start/Stop/Restart individual services |

## Supported Frameworks and Applications
PHP Caddy comes with the same default set of drivers as Valet, so out of the box it supports:

- Laravel
- Lumen
- Symfony
- Zend
- CakePHP 3
- WordPress
- Bedrock
- Craft
- Statamic
- Jigsaw
- Static HTML

### Custom Valet Drivers
 
You can write your own Valet driver to support PHP applications not in the list above, in the same way you can with
Laravel Valet.  

When you install PHP Caddy, a `~/.phpcaddy/Drivers` directory is created which contains a `SampleValetDriver.php` file
you can use as a guide.  To use your custom driver, either place it in the `~/.phpcaddy/Drivers` directory, or in the 
root path of your project, and it will be picked up by PHP Caddy.

See more info on creating custom drivers in the Laravel Valet docs: 
[Custom Valet Drivers](https://laravel.com/docs/5.4/valet#custom-valet-drivers) 

## Upgrading
You can update PHP Caddy using the `composer global update` command.  After upgrading, you may need to run 
`caddy install` to make any necessary configuration changes.

## License and Attribution
Parts of the original [Laravel Valet](https://laravel.com/docs/5.4/valet) source code were used in whole or in part 
in building this project, and are covered under the original Valet License 
- [Valet License](ValetLicense.txt)

The Caddy and Mailhog binaries are covered under their respective licenses. 
- [Caddy License](bin/CaddyLicense.txt) 
- [Mailhog License](bin/MailhogLicense.txt)

PHP Caddy is Copyright (c) 2017 Dave Samojlenko and licensed under the MIT license 
- [PHP Caddy License](LICENSE.txt)

![Powered by Caddy](https://raw.githubusercontent.com/dsamojlenko/php-caddy/master/powered-by-caddy.png)
