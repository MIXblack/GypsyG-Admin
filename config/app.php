<?php

    return [

        'database' => [

            'driver' => 'mysql',
            'host' => 'localhost',
            'dbname' => 'gypsyg_db',
            'username' => 'root',
            'password' => ''

        ],

        'mail' => [

            'transport' => 'smtp',
            'encrption' => 'tls',   
            'port' => '587',
            'host' => 'smtp.gmail.com',
            'username' => 'gypsyg.team@gmail.com',
            'password' => 'narayanshaw@',
            'from' => 'no-reply@gypsyg.team@gmail.com',
            'sender_name' => 'GypsyG | Powered by MIXblack'

        ]

    ];

?>