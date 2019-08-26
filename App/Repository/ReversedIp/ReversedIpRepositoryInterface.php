<?php


namespace App\Repository\ReversedIp;


interface ReversedIpRepositoryInterface
{
    public function getHostsByIps(array $ips = [], int $page = 1): \Generator;
}