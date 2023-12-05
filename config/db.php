<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=mysql:3306;dbname=testyii;unix_socket=/var/lib/mysql',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
