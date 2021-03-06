<p align="center"><img src="https://tgram.ru/wiki/bots/image/botfather.jpg"></p>
###### Instruction for creating a telegram bot

1. Prepare a website with SSL sertificate, you should be able to access your website with HTTPS protocol, for example `https://sitename.com`
2. Create a bot itself using the botfather bot in telegram [@BotFather](https://t.me/botfather)
you must have its TOKEN, save it for later use
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

var_dump($response);
```

4. Now access your file by visiting it in your browser, this will set the webhook for your bot to
send messages to your server, for example:
`https://sitename.com/setwebhook.php`
If you see this response then everything works
```
string(57) "{"ok":true,"result":true,"description":"Webhook was set"}" 
```
5. Now its time to create bot main `telegram-bot.php` file

```
<?php

const TELEGRAM_TOKEN    = "YOUR_TELEGRAM_TOKEN";
const TELEGRAM_BASE_URL = "https://api.telegram.org/bot" . TELEGRAM_TOKEN . "/";

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

// logging into log.txt everything what telegram API is sending to us
file_put_contents(__DIR__ . '/log.txt', file_get_contents('php://input'), FILE_APPEND);

// Your bot always answers this message
$text = 'Hello new telegram bot developer!';

// giving an answer
sendTelegramRequest('sendMessage', ['chat_id' => $update['message']['chat']['id'], 'text' => $text]);
```
6. Now start the conversation with your bot and send him a message, it must answer you with 
a message `Hello new telegram bot developer!`
