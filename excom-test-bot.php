<?php

const TOKEN    = "714102384:AAGMXOM-GKe1UUuQ0Y4CVJ0JyV3MdYLgceg";
const BASE_URL = "https://api.telegram.org/bot" . TOKEN . "/";

function sendRequest($method, $params = []){
    if (!empty($params)) {
        $url = BASE_URL . $method . '?' . http_build_query($params);
    } else {
        $url = BASE_URL . $method;
    }

    return json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);
}

// getting an update
$update = json_decode(file_get_contents('php://input'), JSON_OBJECT_AS_ARRAY);

// logging into log.txt
file_put_contents(__DIR__ . '/log.txt', file_get_contents('php://input'), FILE_APPEND);

// giving an answer
sendRequest('sendMessage', ['chat_id' => $update['message']['chat']['id'], 'text' => 'Я пока не умею искать видео на utube но я могу показать видео с песиками: https://www.youtube.com/watch?v=4u684DP9WhQ Завтра доделаю поиск видео :)']);
