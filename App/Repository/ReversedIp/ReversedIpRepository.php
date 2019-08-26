<?php


namespace App\Repository\ReversedIp;


use Database\DatabaseInterface;

class ReversedIpRepository implements ReversedIpRepositoryInterface
{

    const ROWS_PER_QUERY = 300;

    /**
     * @var DatabaseInterface
     */
    private $db;

    public function __construct(DatabaseInterface $db)
    {
        $this->db = $db;
    }

    public function getHostsByIps(array $ips = [], $page = 1): \Generator
    {
        $query = "SELECT site FROM records WHERE ";

        $where = str_repeat('address = ? OR ', count($ips));
        $where = rtrim($where, 'OR ');

        $limit = self::ROWS_PER_QUERY;
        $offset = ($page - 1) * self::ROWS_PER_QUERY;

        $query.= $where . " LIMIT $offset, $limit";

        $fetchedData = $this->db->query($query)->execute($ips)->fetch();

        foreach ($fetchedData as $item) {
            foreach ($item as $addresses) {
                yield $addresses['site'];
            }
        }
    }
}