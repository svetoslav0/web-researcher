<?php

session_start();
spl_autoload_register();

$dbInfo = parse_ini_file('Config/db.ini');
$pdo = new PDO($dbInfo['dsn'], $dbInfo['user'], $dbInfo['pass']);

$db = new \Database\PDODatabase($pdo);

$dataBinder = new \Core\DataBinder();

$reversedIpRepository = new \App\Repository\ReversedIp\ReversedIpRepository($db);

$dnsApiService = new \App\Service\DnsGoogleApi\DnsApiService($dataBinder);
$reversedIpService = new \App\Service\ReversedIp\ReversedIpService($dnsApiService, $reversedIpRepository);

$reversedIpHttpHandler = new \App\Http\ReversedIpHttpHandler($reversedIpService);

