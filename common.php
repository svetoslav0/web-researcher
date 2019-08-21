<?php

session_start();
spl_autoload_register();

$dbInfo = parse_ini_file('Config/db.ini');
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);

$db = new \Database\PDODatabase($pdo);

$reversedIpHttpHandler = new \App\Http\ReversedIpHttpHandler();

