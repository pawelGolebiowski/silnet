<?php

/**
 * Class for creating log file
 */
class Logger
{
    /**
     * Function that creates a 'log.txt' file in the logs directory and saves information there.
     *
     * @param string $operation Description of the operation performed.
     *
     * @return void
     */
    public static function show_logs(string $description): void
    {
        $file = '../../logs/log.txt';

        $client_ip = $_SERVER['REMOTE_ADDR'];
        $server = $_SERVER['HTTP_HOST'];
        date_default_timezone_set('Europe/Warsaw');
        $time = date('Y-m-d h:i:s', time());

        $content = file_get_contents($file);
        $content .= "$client_ip\t$server\t$time\t$description\r";

        file_put_contents($file, $content);
    }
}