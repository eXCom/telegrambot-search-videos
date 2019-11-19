<?php
// UTUBE_TOKEN owner = excom.testmail@gmail.com
const UTUBE_TOKEN = "AIzaSyByUXfyENWntObaiEM19nznR-Lk2QVT-iQ";
const UTUBE_BASE_URL    = "https://www.googleapis.com/youtube/v3/search";
const UTUBE_MAX_RESULTS = 3;

function sendUtubeRequest($params = []){
    if (!empty($params)) {
        $url = UTUBE_BASE_URL . '?' . http_build_query($params);
    } else {
        $url = UTUBE_BASE_URL;
    }

    return json_decode(file_get_contents($url), JSON_OBJECT_AS_ARRAY);
}

$utube_params = [
    'key'        => UTUBE_TOKEN,
    'part'       => 'snippet',
    'maxResults' => UTUBE_MAX_RESULTS,
    'type'       => 'video',
    'q'          => 'how to play the piano',
    'order'      => 'viewCount',
];

$videoList = sendUtubeRequest($utube_params);

/*echo "<pre>";
print_r($videoList);
echo "</pre>";*/

foreach($videoList['items'] as $video) {
    echo 'https://www.youtube.com/watch?v=' . $video['id']['videoId'] . '<br>';
}