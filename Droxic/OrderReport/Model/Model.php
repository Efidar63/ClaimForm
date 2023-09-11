<?php
namespace Droxic\OrderReport\Model;

use Magento\Framework\Registry;
use Magento\Framework\App\ObjectManager;
use Magento\Framework\App\ResourceConnection;

class Model
{
    protected $registry;
    protected $connection;

    public function __construct(
        Registry $registry,
        ResourceConnection $resource
    ) {
        $this->registry = $registry;
        $this->connection = $resource->getConnection();
    }

    public function getReportData($dateTo, $dateFrom, $affiliateId)
    {

           $select = $this->connection->select()
               ->from(['o' => 'sales_order'])
               ->where('o.created_at >= ?', $dateFrom)
               ->where('o.created_at <= ?', $dateTo)
               ->where('o.affiliate_id = ?', $affiliateId);
            $orders = $this->connection->fetchAll($select);
            return $orders;
        }

    public function getAffiliateIds()
    {
        // SELECT `affiliate_id` FROM `sales_order` WHERE `affiliate_id` IS NOT NULL GROUP BY `affiliate_id`;

           $select = $this->connection->select()
               ->from(['o' => 'sales_order'], ['affiliate_id'])
               ->where('o.affiliate_id IS NOT NULL')
               ->group('affiliate_id');
            $affilitaIds = $this->connection->fetchAll($select);
            return $affilitaIds;
    }

    }

