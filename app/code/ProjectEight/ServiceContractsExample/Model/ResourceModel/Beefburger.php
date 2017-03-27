<?php


namespace ProjectEight\ServiceContractsExample\Model\ResourceModel;

class Beefburger extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('projecteight_beefburger', 'beefburger_id');
    }
}
