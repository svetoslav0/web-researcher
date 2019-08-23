<?php


namespace App\Repository\ReversedIp;


use Database\DatabaseInterface;

class ReversedIpRepository implements ReversedIpRepositoryInterface
{
    /**
     * @var DatabaseInterface
     */
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function getHostsByIps(array $ips = []): \Generator
    {
        $query = "SELECT site FROM records WHERE ";

        $where = str_repeat('address = ? OR ', count($ips));
        $where = rtrim($where, 'OR ');

        $query.= $where . " LIMIT 10000";

        $fetchedData = $this->db->query($query)->execute($ips)->fetch();


        foreach ($fetchedData as $item) {
            foreach ($item as $addresses) {
                yield $addresses['site'];
            }
        }
    }
}