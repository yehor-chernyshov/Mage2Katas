<?php


namespace ProjectEight\ServiceContractsExample\Api\Data;

interface BeefburgerSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Beefburger list.
     * @return \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface[]
     */
    
    public function getItems();

    /**
     * Set name list.
     * @param \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
