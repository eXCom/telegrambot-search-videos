<?php

const TELEGRAM_TOKEN    = "714102384:AAGMXOM-GKe1UUuQ0Y4CVJ0JyV3MdYLgceg";
const TELEGRAM_BASE_URL = "https://api.telegram.org/bot" . TELEGRAM_TOKEN . "/";

const UTUBE_TOKEN       = "AIzaSyByUXfyENWntObaiEM19nznR-Lk2QVT-iQ";
const UTUBE_BASE_URL    = "https://www.googleapis.com/youtube/v3/search";
const UTUBE_MAX_RESULTS = 5;

function sendUtubeRequest($params = []){
    if (!empty($params)) {
        $url = UTUBE_BASE_URL . '?' . http_build_query($params);
    } else {
        $url = UTUBE_BASE_URL;
    }

    return json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);
}

function sendTelegramRequest($method, $params = []){
    if (!empty($params)) {
        $url = TELEGRAM_BASE_URL . $method . '?' . http_build_query($params);
    } else {
        $url = TELEGRAM_BASE_URL . $method;
    }

    return json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);
}

// getting an update
$update = json_decode(file_get_contents('php://input'), JSON_OBJECT_AS_ARRAY);

// logging into log.txt
file_put_contents(__DIR__ . '/log.txt', file_get_contents('php://input'), FILE_APPEND);

$utube_params = [
    'key'        => UTUBE_TOKEN,
    'part'       => 'snippet',
    'maxResults' => UTUBE_MAX_RESULTS,
    'type'       => 'video',
    'q'          => $update['message']['text'],
    'order'      => 'viewCount',
];

$videoListResponse = sendUtubeRequest($utube_params);
$video_list = [];
foreach($videoListResponse['items'] as $video) {
    $video_list[] = 'https://www.youtube.com/watch?v=' . $video['id']['videoId'];
}

$text = implode(' ', $video_list);

// giving an answer
sendTelegramRequest('sendMessage', ['chat_id' => $update['message']['chat']['id'], 'text' => $text]);
