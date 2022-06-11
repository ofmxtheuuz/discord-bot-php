<?php

include __DIR__ . '/vendor/autoload.php';

use Discord\Discord;
use Discord\Parts\Channel\Message;
use Discord\WebSockets\Event;
use Discord\Builders\MessageBuilder;
use Discord\Builders\Components\ActionRow;
use Discord\Builders\Components\Button;
use Discord\Interaction;

$discord = new Discord([
    'token' => 'OTgyNjM4NTEyNDg4NzIyNDUy.GHNIB0.6AduxojwvD2ac5irPkPoCjfpYNffjzx6_n856s',
]);

$discord->on('ready', function (Discord $discord) {
    echo "Bot is ready!", PHP_EOL;

    // Listen for messages
    $discord->on(Event::MESSAGE_CREATE, function (Message $message, Discord $discord) {
        if ($message->content == '!Hello') { // 1

            $builder = MessageBuilder::new();
            $builder->setContent('Hello, World!');

            $actionRow = ActionRow::new();
            $buttonSuccess = Button::new(Button::STYLE_SUCCESS);
            $buttonSuccess->setLabel('Click');
            $actionRow->addComponent($buttonSuccess);
            $builder->addComponent($actionRow);

            $message->channel->sendMessage($builder);
            
            $buttonSuccess->setListener(function ($interaction) use ($discord) {
                $interaction->user->sendMessage(MessageBuilder::new()->setContent("Hello, World!"));
            }, $discord);
        }
    });
});

$discord->run();
