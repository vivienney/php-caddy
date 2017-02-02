# Introduction
PHP Caddy is a **tiny** PHP development environment for Windows, inspired by Laravel Valet.

**No hosts file, no configuration.  Just run it and go.**

PHP Caddy is basically a stripped down Valet: no *.dev domain proxy (only localhost), no linking multiple sites, 
and no sharing over local tunnels.  At least for now ;)

Built with [Caddy](https://caddyserver.com/) web server, PHP Caddy also includes [Mailhog](https://github.com/mailhog/MailHog) 
for catching email sent by your application.

**NOTE**: This package is for minimalists.  It does not have the full feature set of Valet, and it doesn't provide the
robust features of a virtualized environment like Homestead.
- If you are on MacOS you should probably just use [Laravel Valet](https://laravel.com/docs/5.4/valet).  
- If you want something more Valet-like for Windows, check out [Valet4Windows](https://github.com/vitr/valet4windows).
- If you want a fully virtualized Linux development environment, use [Laravel Homestead](https://laravel.com/docs/5.4/homestead).
- If you want a fast, simple to use local development environment with minimal resource consumption, read on!

## Requirements
- [PHP](http://windows.php.net/) (installed in C:\php and configured for Laravel)
- [Composer](https://getcomposer.org/)
- A database, if you need (MySql/Mariadb/Sqlite)

## Installation instructions
```
composer global config repositories.repo-name vcs https://gitlab.com/gcsx/caddy.git
composer global require gcsx/caddy:dev-master
```

## Usage
Make sure your global composer/vendor/bin folder is in your system path.

### Start it up:
```
cd {your laravel project directory}
caddy up
```

Site will be available at:
http://localhost

Mailhog will be available at http://localhost:8025

Set your outgoing SMTP to 127.0.0.1:1025

### Shut it down:
```
caddy down
```

## Supported Frameworks and Applications
PHP Caddy comes with the same set of default drivers as Valet, so out of the
box it supports:

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