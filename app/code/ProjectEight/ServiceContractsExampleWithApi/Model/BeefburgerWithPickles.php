<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Model;

use ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface;

class BeefburgerWithPickles extends \Magento\Framework\Model\AbstractModel implements BeefburgerWithPicklesInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ProjectEight\ServiceContractsExampleWithApi\Model\ResourceModel\BeefburgerWithPickles');
    }

    /**
     * Get beefburgerwithpickles_id
     * @return string
     */
    public function getBeefburgerwithpicklesId()
    {
        return $this->getData(self::BEEFBURGERWITHPICKLES_ID);
    }

    /**
     * Set beefburgerwithpickles_id
     * @param string $beefburgerwithpicklesId
     * @return ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface
     */
    public function setBeefburgerwithpicklesId($beefburgerwithpicklesId)
    {
        return $this->setData(self::BEEFBURGERWITHPICKLES_ID, $beefburgerwithpicklesId);
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
}
