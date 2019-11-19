<?php

const TOKEN    = "714102384:AAGMXOM-GKe1UUuQ0Y4CVJ0JyV3MdYLgceg";
//const BASE_URL = "https://api.telegram.org/bot" . TOKEN . "/";

$method = 'setWebhook';
$url = "https://api.telegram.org/bot" . TOKEN . "/" . $method;
$options = [
    'url' => 'https://excom.te.ua/excom-test-bot.php'
];

$response = file_get_contents($url . '?' . http_build_query($options));

var_dump($response);