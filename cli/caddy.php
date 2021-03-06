<?php

use Silly\Edition\PhpDi\Application;

$version = '1.3.4';

$app = new Application('PHP Caddy', $version);

$app->command('install', 'Caddy\Command\InstallCommand')
    ->descriptions('Install the PHP Caddy services');

$app->command('link', 'Caddy\Command\LinkCommand')
    ->descriptions('Link the current directory');

$app->command('service [service] [cmd]', 'Caddy\Command\ServiceCommand')
    ->descriptions('Control individual services');

$app->command('start [--without-mailhog]', 'Caddy\Command\StartCommand')
    ->descriptions('Start up the PHP Cadddy services');

$app->command('stop', 'Caddy\Command\StopCommand')
    ->descriptions('Stop the PHP Caddy services');

$app->command('uninstall', 'Caddy\Command\UninstallCommand')
    ->descriptions('Uninstall the PHP Caddy services');

$app->command('which', 'Caddy\Command\WhichCommand')
    ->descriptions('Determine which Valet driver serves the current working directory');

$app->run();