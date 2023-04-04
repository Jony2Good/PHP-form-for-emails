<?php

$fields = [
    'name' => [
        'field_name' => 'Name',
        'required' => 1,
    ],
    'email' => [
        'field_name' => 'Email',
        'required' => 1,
    ],
    'address' => [
        'field_name' => 'Address',
        'required' => 0,
    ],
    'phone' => [
        'field_name' => 'Phone',
        'required' => 1,
    ],
    'comments' => [
        'field_name' => 'Comments',
        'required' => 0,
    ],
     'captcha' => [
        'field_name' => 'Captcha',
        'required' => 1,
        'mailable' => 0,
    ],
  ];

$mail_settings = [
    'host' => 'smtp.yandex.com',
    'smtp_auth' => true,
    'username' => 'test1ng2023@yandex.ru',
    'password' => 'E112233art',
    'smtp_secure' => 'tls',
    'port' => 587,
    'from_email' => 'test1ng2023@yandex.ru',
    'from_name' => 'PHP testing form',
    'to_email' => 'test1ng2023@yandex.ru',
];

