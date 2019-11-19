<p align="center"><img src="https://tgram.ru/wiki/bots/image/botfather.jpg"></p>
## Instruction for creating a telegram bot!

1. Prepare a website with SSL sertificate, you should be able to access your website with HTTPS protocol, for example `https://sitename.com`
2. Create a bot itself using the botfather bot in telegram [@BotFather](https://t.me/botfather)
3. Create a new file on your website with a name **setwebhook.php** (name really doesnt matter) with this code:
```<?php

const TOKEN    = "YOUR_TELEGRAM_BOT_TOKEN";
//const BASE_URL = "https://api.telegram.org/bot" . TOKEN . "/";

$method = 'setWebhook';
$url = "https://api.telegram.org/bot" . TOKEN . "/" . $method;
$options = [
    'url' => 'https://sitename.com/telegram-bot.php'
];

$response = file_get_contents($url . '?' . http_build_query($options));

var_dump($response);```

4. Now access your file by visiting it in your browser, this will set the webhook for your bot to send messages to your server, 
for example:
`https://sitename.com/setwebhook.php`
If you see this response than everything works
```
string '{"ok":true,"result":true,"description":"Webhook is already set"}' (length=64)
```
