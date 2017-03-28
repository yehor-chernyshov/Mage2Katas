<?php


namespace ProjectEight\ServiceContractsExample\Model;

use ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface;

class Beefburger extends \Magento\Framework\Model\AbstractModel implements BeefburgerInterface
{

    /**
     * Beefburger constructor
     * @return void
     */
    protected function _construct()
    {
        $this->_init('ProjectEight\ServiceContractsExample\Model\ResourceModel\Beefburger');
    }

    /**
     * Get beefburger_id
     * @return string
     */
    public function getBeefburgerId()
    {
        return $this->getData(self::BEEFBURGER_ID);
    }

    /**
     * Set beefburger_id
     * @param string $beefburgerId
     * @return ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface
     */
    public function setBeefburgerId($beefburgerId)
    {
        return $this->setData(self::BEEFBURGER_ID, $beefburgerId);
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
     * @return ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }
}
