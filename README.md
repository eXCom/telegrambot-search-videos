<p align="center"><img src="https://tgram.ru/wiki/bots/image/botfather.jpg"></p>
## Instruction for creating a telegram bot!

1. Prepare a website with SSL sertificate, you should be able to access your website with HTTPS protocol, for example `https://sitename.com`
2. Create a bot itself using the botfather bot in telegram [@BotFather](https://t.me/botfather)
3. Create a new file on your website with a name setwebhook.php (name really doesnt matter) with this code:
```<?php

const TOKEN    = "714102384:AAGMXOM-GKe1UUuQ0Y4CVJ0JyV3MdYLgceg";
//const BASE_URL = "https://api.telegram.org/bot" . TOKEN . "/";

$method = 'setWebhook';
$url = "https://api.telegram.org/bot" . TOKEN . "/" . $method;
$options = [
    'url' => 'https://excom.te.ua/excom-test-bot.php'
];

$response = file_get_contents($url . '?' . http_build_query($options));

var_dump($response);```
4. 
