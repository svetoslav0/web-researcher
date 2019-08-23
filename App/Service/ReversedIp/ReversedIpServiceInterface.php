<?php


namespace App\Service\ReversedIp;


interface ReversedIpServiceInterface
{
    /**
     * @param array $getData
     * @return \Generator
     */
    public function findMatchingAddresses(array $getData): \Generator;

    public function isValidIpAddress(string $target): bool;
}