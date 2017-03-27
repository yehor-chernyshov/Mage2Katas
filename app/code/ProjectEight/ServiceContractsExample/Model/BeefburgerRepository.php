<?php


namespace ProjectEight\ServiceContractsExample\Model;

use ProjectEight\ServiceContractsExample\Api\BeefburgerRepositoryInterface;
use ProjectEight\ServiceContractsExample\Api\Data\BeefburgerSearchResultsInterfaceFactory;
use ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use ProjectEight\ServiceContractsExample\Model\ResourceModel\Beefburger as ResourceBeefburger;
use ProjectEight\ServiceContractsExample\Model\ResourceModel\Beefburger\CollectionFactory as BeefburgerCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class BeefburgerRepository implements BeefburgerRepositoryInterface
{

    protected $resource;

    protected $BeefburgerFactory;

    protected $BeefburgerCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataBeefburgerFactory;

    private $storeManager;


    /**
     * @param ResourceBeefburger $resource
     * @param BeefburgerFactory $beefburgerFactory
     * @param BeefburgerInterfaceFactory $dataBeefburgerFactory
     * @param BeefburgerCollectionFactory $beefburgerCollectionFactory
     * @param BeefburgerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceBeefburger $resource,
        BeefburgerFactory $beefburgerFactory,
        BeefburgerInterfaceFactory $dataBeefburgerFactory,
        BeefburgerCollectionFactory $beefburgerCollectionFactory,
        BeefburgerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->beefburgerFactory = $beefburgerFactory;
        $this->beefburgerCollectionFactory = $beefburgerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBeefburgerFactory = $dataBeefburgerFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface $beefburger
    ) {
        /* if (empty($beefburger->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $beefburger->setStoreId($storeId);
        } */
        try {
            $this->resource->save($beefburger);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the beefburger: %1',
                $exception->getMessage()
            ));
        }
        return $beefburger;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($beefburgerId)
    {
        $beefburger = $this->beefburgerFactory->create();
        $beefburger->load($beefburgerId);
        if (!$beefburger->getId()) {
            throw new NoSuchEntityException(__('Beefburger with id "%1" does not exist.', $beefburgerId));
        }
        return $beefburger;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $collection = $this->beefburgerCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        $searchResults->setTotalCount($collection->getSize());
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        $items = [];
        
        foreach ($collection as $beefburgerModel) {
            $beefburgerData = $this->dataBeefburgerFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $beefburgerData,
                $beefburgerModel->getData(),
                'ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface'
            );
            $items[] = $this->dataObjectProcessor->buildOutputDataArray(
                $beefburgerData,
                'ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface'
            );
        }
        $searchResults->setItems($items);
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \ProjectEight\ServiceContractsExample\Api\Data\BeefburgerInterface $beefburger
    ) {
        try {
            $this->resource->delete($beefburger);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Beefburger: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($beefburgerId)
    {
        return $this->delete($this->getById($beefburgerId));
    }
}
