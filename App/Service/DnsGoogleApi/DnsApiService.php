<?php


namespace App\Service\DnsGoogleApi;


use App\Data\GoogleDnsApiDTO;
use Core\DataBinderInterface;

class DnsApiService implements DnsApiServiceInterface
{

    /**
     * @var DataBinderInterface
     */
    private $dataBinder;

    public function __construct(DataBinderInterface $dataBinder)
    {
        $this->dataBinder = $dataBinder;
    }

    public function findIpAddressesByHostName(string $hostname): array
    {
        $apiResponse = json_decode(
            file_get_contents("https://dns.google/resolve?name={$hostname}&type=A")
        );

        /** @var GoogleDnsApiDTO $apiAnswer */
        $apiAnswer = $this->dataBinder->bind($apiResponse, GoogleDnsApiDTO::class);

        if (property_exists(GoogleDnsApiDTO::class, "answer")) {
            $ips = [];

            if ($apiAnswer->getAnswer() == null) {
                return [];
            }

            foreach ($apiAnswer->getAnswer() as $currentAddress) {
                $ips[] = $currentAddress->data;
            }

            return $ips;
        }

        return [];
    }
}