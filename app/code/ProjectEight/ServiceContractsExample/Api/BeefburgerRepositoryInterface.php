<?php


namespace ProjectEight\ServiceContractsExample\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface BeefburgerRepositoryInterface
{


    /**
     * Save Beefburger
     * @param \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface $beefburger
     * @return \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface $beefburger
    );

    /**
     * Retrieve Beefburger
     * @param string $beefburgerId
     * @return \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($beefburgerId);

    /**
     * Retrieve Beefburger matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Beefburger
     * @param \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface $beefburger
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface $beefburger
    );

    /**
     * Delete Beefburger by ID
     * @param string $beefburgerId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($beefburgerId);
}
