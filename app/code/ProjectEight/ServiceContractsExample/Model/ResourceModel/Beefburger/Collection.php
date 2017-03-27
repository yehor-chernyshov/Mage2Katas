<?php


namespace ProjectEight\ServiceContractsExample\Model\ResourceModel\Beefburger;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'ProjectEight\ServiceContractsExample\Model\Beefburger',
            'ProjectEight\ServiceContractsExample\Model\ResourceModel\Beefburger'
        );
    }
}
