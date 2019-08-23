<?php

namespace App\Service\ReversedIp;


use App\Repository\ReversedIp\ReversedIpRepositoryInterface;
use App\Service\DnsGoogleApi\DnsApiServiceInterface;

class ReversedIpService implements ReversedIpServiceInterface
{

    /**
     * @var DnsApiServiceInterface
     */
    private $dnsApiService;

    /**
     * @var ReversedIpRepositoryInterface
     */
    private $reversedIpRepository;

    public function __construct(
        DnsApiServiceInterface $dnsApiService,
        ReversedIpRepositoryInterface $reversedIpRepository
    )
    {
        $this->dnsApiService = $dnsApiService;
        $this->reversedIpRepository = $reversedIpRepository;
    }

    /**
     * @param array $getData
     * @return \Generator
     */
    public function findMatchingAddresses(array $getData): \Generator
    {
        $inputData = $getData['target'];

        $allAddresses = [];

        if (!$this->isValidIpAddress($inputData)) {
            $allAddresses = $this->dnsApiService->findIpAddressesByHostName($inputData);
        } else {
            $allAddresses = [$inputData];
        }


        $validAddresses = [];
        foreach ($allAddresses as $address) {
            if ($this->isValidIpAddress($address)) {
                $validAddresses[] = $address;
            }
        }

        $fetchedHosts = $this->reversedIpRepository->getHostsByIps($validAddresses);

        foreach ($fetchedHosts as $fetchedHost) {
            yield $fetchedHost;
        }

    }

    public function isValidIpAddress(string $target): bool
    {
        return ip2long($target) !== false;
    }
}