<?php

return [
    'host' => 'db',
    'db' => getenv('MYSQL_DATABASE'),
    'user' => getenv('MYSQL_USER'),
    'pass' => getenv('MYSQL_PASSWORD'),
    'charset' => 'utf8mb4',
];