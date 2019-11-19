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

/*echo "<pre>";
print_r(sendRequest('getUpdates'));
echo "</pre>";*/

/*echo "<pre>";
print_r(sendRequest('sendMessage', ['chat_id' => 592818574, 'text' => 'Im bot!']));
echo "</pre>";*/

$updates = sendRequest('getUpdates');

foreach($updates['result'] as $update) {
    $chat_id = $update['message']['chat']['id'] . '<br>';
    sendRequest('sendMessage', ['chat_id' => $chat_id, 'text' => 'Answer']);
}