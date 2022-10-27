<?php

return [
    'app_version' => env('APP_VERSION', '1.1.2'),
    'TAGS' => [
        '{name}', '{email}', '{company_name}',
        '{phone}', '{address}', '{total_due}',
        '{due_date}', '{user}', '{invoice_no}',
        '{quotation_no}', '{user_name}'
    ],
    'EMAIL' => [
        'bank' => '',
        'branch' => '',
        'acc_number' => '',
        'acc_name' => '',

        'show_bank' => 0
    ],
    'RECURRING_INTERVALS' => [
        '1d' => [
            'label' => '1 Day',
            'value' => 1
        ],
        '1w' => [
            'label' => '1 Week',
            'value' => 7
        ],
        '2w' => [
            'label' => '2 Weeks',
            'value' => 14
        ],
        '1m' => [
            'label' => '1 Month',
            'value' => 30
        ],
        '2m' => [
            'label' => '2 Months',
            'value' => 60
        ],
        '3m' => [
            'label' => '3 Months',
            'value' => 90
        ],
        '4m' => [
            'label' => '4 Months',
            'value' => 120
        ],
    ]


];
