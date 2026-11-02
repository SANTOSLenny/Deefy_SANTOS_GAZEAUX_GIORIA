<?php

require_once 'vendor/autoload.php';

use iutnc\deefy\dispatch\Dispatcher;
use iutnc\deefy\repository\DeefyRepository;

session_start();

DeefyRepository::setConfig(
    __DIR__ . '/src/config/deefy.db.ini'
);

$dispatcher = new Dispatcher();
$dispatcher->run();