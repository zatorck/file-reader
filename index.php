<?php
echo readFileToEnd(__DIR__."/sample.txt");

function readFileToEnd($path)
{
    if (!file_exists($path)) {
        throw new Exception('File not found');
    }
    if (filesize($path) > 10485760) {
        throw new Exception('File to big');
    }

    $text = '';
    try {
        $file = fopen($path, "r");

        if ($file) {
            while (!feof($file)) {
                $line = fgets($file);
                if (substr($line, 0, strlen('__KONIEC__')) === '__KONIEC__') {
                    break;
                }
                $text .= $line.'<br>';
            }
            fclose($file);
        }
    } catch (Exception $e) {
        return false;
    }

    return $text;
}
