<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Model\ResourceModel;

class BeefburgerWithPickles extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('projecteight_beefburgerwithpickles', 'beefburgerwithpickles_id');
    }
}
