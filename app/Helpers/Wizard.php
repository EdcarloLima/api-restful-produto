<?php

namespace App\Helpers;

trait Wizard
{
    public static function createLog(string $className, \Throwable $error): void
    {
        $dateTime = (new \DateTime())->format('Y_m_d_H_i');
        $name = "app/storage/logs/".$className.'_'.$dateTime.'.txt';
        touch(storage_path($name));
        $path = storage_path($name);
        if (file_exists($path)) {
            $file = fopen($path, 'a+');
            $text = PHP_EOL.$error->getMessage().PHP_EOL.$error->getCode().PHP_EOL.$error->getLine();
            fwrite($file, $text);
            fclose($file);
        }
    }
}