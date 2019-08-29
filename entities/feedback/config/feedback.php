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

    'mails_users' => [
        'send' => false,
        'subject' => 'Ответ на сообщение',
        'headers' => [],
    ],

    'queue' => [
        'enable' => false,
        'name' => 'feedback_notify',
    ],

];
