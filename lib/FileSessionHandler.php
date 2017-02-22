<?php
class FileSessionHandler {

    private $savePath;
    private $lifetime;

    function open($savePath, $sessionName)
    {
        $this->savePath = '/var/session'; // Ignore savepath and use our own to keep it safe from automatic GC
        $this->lifetime = 3600; // 1 hour minimum session duration
        if (!is_dir($this->savePath)) {
            mkdir($this->savePath, 0777);
        }

        return true;
    }

    function close()
    {
        return true;
    }

    function read($id)
    {
        return (string)@file_get_contents("$this->savePath/sess_$id");
    }

    function write($id, $data)
    {
        return file_put_contents("$this->savePath/sess_$id", $data) === false ? false : true;
    }

    function destroy($id)
    {
        $file = "$this->savePath/sess_$id";
        if (file_exists($file)) {
            unlink($file);
        }

        return true;
    }

    function gc($maxlifetime)
    {
        foreach (glob("$this->savePath/sess_*") as $file) {
            if (filemtime($file) + $this->lifetime < time() && file_exists($file)) { // Use our own lifetime
                unlink($file);
            }
        }

        return true;
    }
}

$handler = new FileSessionHandler();
session_set_save_handler(
    array($handler, 'open'),
    array($handler, 'close'),
    array($handler, 'read'),
    array($handler, 'write'),
    array($handler, 'destroy'),
    array($handler, 'gc')
);

// the following prevents unexpected effects when using objects as save handlers
register_shutdown_function('session_write_close');

session_set_cookie_params(3600); // Set session cookie duration to 1 hour
session_start();
// proceed to set and retrieve values by key from $_SESSION