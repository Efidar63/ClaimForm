<?php

namespace Droxic\InsuranceClaimForm\Model\ResourceModel\Order\Grid;

use Magento\Framework\Data\Collection\Db\FetchStrategyInterface as FetchStrategy;
use Magento\Framework\Data\Collection\EntityFactoryInterface as EntityFactory;
use Magento\Framework\Event\ManagerInterface as EventManager;
use Magento\Sales\Model\ResourceModel\Order;
use Magento\Sales\Model\ResourceModel\Order\Grid\Collection as OrderGridCollection;
use Psr\Log\LoggerInterface as Logger;

class Collection extends OrderGridCollection

{
    public function __construct(
        EntityFactory $entityFactory,
        Logger $logger,
        FetchStrategy $fetchStrategy,
        EventManager $eventManager,
        $mainTable = 'sales_order_grid',
        $resourceModel = Order::class
    ) {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $mainTable, $resourceModel);
    }
    protected function _renderFiltersBefore() {
        $joinTable = $this->getTable('sales_order');
        $this->getSelect()->joinLeft(
            ['sales_order_table' => $joinTable],
            'main_table.entity_id = sales_order_table.entity_id',
            ['insurance_id'] // you can add other attributes here
        );
        parent::_renderFiltersBefore();

    }

}