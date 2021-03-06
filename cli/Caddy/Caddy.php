<?php namespace Caddy;

class Caddy
{
    /**
     * @var Filesystem
     */
    private $files;
    /**
     * @var HiddenConsole
     */
    private $hiddenConsole;

    function __construct(Filesystem $files, HiddenConsole $hiddenConsole)
    {
        $this->files = $files;
        $this->hiddenConsole = $hiddenConsole;
    }

    function install()
    {
        $this->stop();
        $this->createLogDirectory();
        $this->installCaddyFile();
        $this->installCaddyBin();
    }

    function start()
    {
        return $this->restart();
    }

    function restart()
    {
        if (!$this->installed())
        {
            Output::warning('Caddy server is not installed');
            return false;
        }

        $args = '-root ' . PACKAGE_BASE_PATH;
        $args .= ' -conf ' . CADDY_HOME_PATH . '\Caddyfile';

        $this->stop();
        exec($this->hiddenConsole->path() . ' ' . $this->path() . ' ' . $args);
        return true;
    }

    function stop()
    {
        exec('taskkill /im caddy.exe /f >nul 2>&1');
    }

    function installCaddyFile()
    {
        $this->files->put(
            CADDY_HOME_PATH . '\\Caddyfile',
            str_replace('CADDY_HOME_PATH', CADDY_HOME_PATH, $this->files->get(PACKAGE_BASE_PATH . '\\cli\\stubs\\Caddyfile'))
        );
    }

    function installCaddyBin()
    {
        $this->files->put(
            $this->path(),
            $this->files->get(PACKAGE_BASE_PATH . '\\bin\\caddy.exe')
        );
    }

    /**
     * Create the directory for Caddy log.
     *
     * @return void
     */
    function createLogDirectory()
    {
        $this->files->ensureDirExists(CADDY_HOME_PATH.'\\Logs');
        $this->files->touch(CADDY_HOME_PATH.'\\Logs\\access.log');
        $this->files->touch(CADDY_HOME_PATH.'\\Logs\\error.log');
    }

    function uninstall()
    {
        $this->stop();
        $this->files->unlink($this->path());
    }

    function installed()
    {
        return $this->files->exists($this->path());
    }

    function path()
    {
        return CADDY_BIN_PATH . '\\caddy.exe';
    }
}