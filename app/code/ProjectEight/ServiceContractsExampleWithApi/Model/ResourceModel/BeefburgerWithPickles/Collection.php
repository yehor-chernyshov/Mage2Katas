<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Model\ResourceModel\BeefburgerWithPickles;

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
            'ProjectEight\ServiceContractsExampleWithApi\Model\BeefburgerWithPickles',
            'ProjectEight\ServiceContractsExampleWithApi\Model\ResourceModel\BeefburgerWithPickles'
        );
    }
}
