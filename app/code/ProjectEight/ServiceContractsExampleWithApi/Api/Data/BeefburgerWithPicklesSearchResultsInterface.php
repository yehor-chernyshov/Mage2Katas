<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Api\Data;

interface BeefburgerWithPicklesSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get BeefburgerWithPickles list.
     * @return \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface[]
     */
    
    public function getItems();

    /**
     * Set name list.
     * @param \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
