<?php

return [
    "database" => [
        'host' => 'mysql-server', //para trabajar en clase 10.2.218.254, para casa mysql-server
        'dbname' => 'beta_db_bhec_11122023',
        'username' => 'root',
        'password' => 'secret',
        'port'=>3306], // el port dependra de l'entorn de desenvolupament
    'roles' => [
        'customer',
        'employee',
        'private',
        'professional',
        'administrator',
        'administrative'],
    'states' => [
        'pending',
        'processing',
        'completed',
        'cancelled',
        'payed',
        'delivered',
        'shipped'
    ],
];