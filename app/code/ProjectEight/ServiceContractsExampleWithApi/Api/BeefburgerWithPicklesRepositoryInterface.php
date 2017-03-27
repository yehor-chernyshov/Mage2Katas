<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface BeefburgerWithPicklesRepositoryInterface
{


    /**
     * Save BeefburgerWithPickles
     * @param \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface $beefburgerWithPickles
     * @return \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface $beefburgerWithPickles
    );

    /**
     * Retrieve BeefburgerWithPickles
     * @param string $beefburgerwithpicklesId
     * @return \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($beefburgerwithpicklesId);

    /**
     * Retrieve BeefburgerWithPickles matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete BeefburgerWithPickles
     * @param \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface $beefburgerWithPickles
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface $beefburgerWithPickles
    );

    /**
     * Delete BeefburgerWithPickles by ID
     * @param string $beefburgerwithpicklesId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($beefburgerwithpicklesId);
}
