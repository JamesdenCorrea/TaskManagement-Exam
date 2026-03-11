<?php

$_ENV['APP_STORAGE'] = '/tmp';

if (!is_dir('/tmp/storage/framework/views')) {
    mkdir('/tmp/storage/framework/views', 0775, true);
    mkdir('/tmp/storage/framework/cache', 0775, true);
    mkdir('/tmp/storage/framework/sessions', 0775, true);
    mkdir('/tmp/storage/logs', 0775, true);
}

require __DIR__ . '/../public/index.php';