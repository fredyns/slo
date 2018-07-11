<?php

function host_config($filename)
{
    if (file_exists(__DIR__.'/host/'.$filename)) {
        // costum host config
        return require __DIR__.'/host/'.$filename;
    } elseif (file_exists(__DIR__.'/host-sample/'.$filename)) {
        // default config
        return require __DIR__.'/host-sample/'.$filename;
    } else {
        // config not found
        die('Config error!');
    }
}
