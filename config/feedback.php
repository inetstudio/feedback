<?php

return [

    /*
     * Настройки таблиц
     */

    'datatables' => [
        'ajax' => [
            'index' => [
                'url' => 'back.feedback.data',
                'type' => 'POST',
                'data' => 'function(data) { data._token = $(\'meta[name="csrf-token"]\').attr(\'content\'); }',
            ],
        ],
        'table' => [
            'index' => [
                'order' => [
                    5,
                    'desc'
                ],
                'paging' => true,
                'pagingType' => 'full_numbers',
                'searching' => true,
                'info' => false,
                'searchDelay' => 350,
                'language' => [
                    'url' => '/admin/js/plugins/datatables/locales/russian.json',
                ],
            ],
        ],
        'columns' => [
            'index' => [
                ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
                ['data' => 'read', 'name' => 'is_read', 'title' => 'Прочитано', 'searchable' => false],
                ['data' => 'name', 'name' => 'name', 'title' => 'Имя'],
                ['data' => 'email', 'name' => 'email', 'title' => 'Email'],
                ['data' => 'message', 'name' => 'message', 'title' => 'Сообщение'],
                ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Дата создания'],
                ['data' => 'actions', 'name' => 'actions', 'title' => 'Действия', 'orderable' => false, 'searchable' => false],
            ],
        ],
    ],

    /*
     * Настройки писем
     */

    'mails' => [
        'to' => '',
        'subject' => '',
        'headers' => [
            'X-MC-Subaccount' => '',
        ],
    ],

    'queue' => [
        'enable' => false,
        'name' => 'feedback_notify',
    ],

];
