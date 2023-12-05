<?php
$db = require __DIR__ . '/db.php';
// test database! Important not to run tests on production or development databases
$db['dsn'] = 'mysql:host=mysql:3306;dbname=testyii;unix_socket=/var/lib/mysql';

return $db;
