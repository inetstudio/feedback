<?php

return [
    /*
     * Настройки писем
     */

    'mails_admins' => [
        'send' => false,
        'to' => [],
        'subject' => 'Новое сообщение',
        'headers' => [],
    ],

    'queue' => [
        'enable' => false,
        'name' => 'feedback_notify',
    ],

];
