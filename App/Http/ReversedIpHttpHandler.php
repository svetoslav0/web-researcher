<?php


namespace App\Http;

use App\Service\ReversedIp\ReversedIpServiceInterface;

class ReversedIpHttpHandler
{
    /**
     * @var ReversedIpServiceInterface
     */
    private $reversedIpService;


    public function __construct(ReversedIpServiceInterface $reversedIpService)
    {
        $this->reversedIpService = $reversedIpService;
    }

    public function handleRequest(array $getData)
    {
        $hosts = [];

        $fetchedData = $this->reversedIpService->findMatchingAddresses($getData);

        foreach ($fetchedData as $fetchedDatum) {
            $hosts[] = $fetchedDatum;
        }

        $this->responseWithJson($hosts);
    }

    private function responseWithJson(array $hosts)
    {
        header('Content-Type: application/json');
        echo json_encode($hosts);
    }
}