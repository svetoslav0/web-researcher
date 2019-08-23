<?php


namespace App\Repository\ReversedIp;


interface ReversedIpRepositoryInterface
{
    public function getHostsByIps(array $ips = []): \Generator;
}