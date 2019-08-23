<?php


namespace App\Service\DnsGoogleApi;


interface DnsApiServiceInterface
{
    public function findIpAddressesByHostName(string $hostname): array;
}