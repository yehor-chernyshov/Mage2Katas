<?php


namespace ProjectEight\ServiceContractsExampleWithApi\Model;

use ProjectEight\ServiceContractsExampleWithApi\Api\BeefburgerWithPicklesRepositoryInterface;
use ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesSearchResultsInterfaceFactory;
use ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Reflection\DataObjectProcessor;
use ProjectEight\ServiceContractsExampleWithApi\Model\ResourceModel\BeefburgerWithPickles as ResourceBeefburgerWithPickles;
use ProjectEight\ServiceContractsExampleWithApi\Model\ResourceModel\BeefburgerWithPickles\CollectionFactory as BeefburgerWithPicklesCollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class BeefburgerWithPicklesRepository implements BeefburgerWithPicklesRepositoryInterface
{

    protected $resource;

    protected $BeefburgerWithPicklesFactory;

    protected $BeefburgerWithPicklesCollectionFactory;

    protected $searchResultsFactory;

    protected $dataObjectHelper;

    protected $dataObjectProcessor;

    protected $dataBeefburgerWithPicklesFactory;

    private $storeManager;


    /**
     * @param ResourceBeefburgerWithPickles $resource
     * @param BeefburgerWithPicklesFactory $beefburgerWithPicklesFactory
     * @param BeefburgerWithPicklesInterfaceFactory $dataBeefburgerWithPicklesFactory
     * @param BeefburgerWithPicklesCollectionFactory $beefburgerWithPicklesCollectionFactory
     * @param BeefburgerWithPicklesSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceBeefburgerWithPickles $resource,
        BeefburgerWithPicklesFactory $beefburgerWithPicklesFactory,
        BeefburgerWithPicklesInterfaceFactory $dataBeefburgerWithPicklesFactory,
        BeefburgerWithPicklesCollectionFactory $beefburgerWithPicklesCollectionFactory,
        BeefburgerWithPicklesSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->beefburgerWithPicklesFactory = $beefburgerWithPicklesFactory;
        $this->beefburgerWithPicklesCollectionFactory = $beefburgerWithPicklesCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataBeefburgerWithPicklesFactory = $dataBeefburgerWithPicklesFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface $beefburgerWithPickles
    ) {
        /* if (empty($beefburgerWithPickles->getStoreId())) {
            $storeId = $this->storeManager->getStore()->getId();
            $beefburgerWithPickles->setStoreId($storeId);
        } */
        try {
            $this->resource->save($beefburgerWithPickles);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the beefburgerWithPickles: %1',
                $exception->getMessage()
            ));
        }
        return $beefburgerWithPickles;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($beefburgerWithPicklesId)
    {
        $beefburgerWithPickles = $this->beefburgerWithPicklesFactory->create();
        $beefburgerWithPickles->load($beefburgerWithPicklesId);
        if (!$beefburgerWithPickles->getId()) {
            throw new NoSuchEntityException(__('BeefburgerWithPickles with id "%1" does not exist.', $beefburgerWithPicklesId));
        }
        return $beefburgerWithPickles;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $collection = $this->beefburgerWithPicklesCollectionFactory->create();
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
        
        foreach ($collection as $beefburgerWithPicklesModel) {
            $beefburgerWithPicklesData = $this->dataBeefburgerWithPicklesFactory->create();
            $this->dataObjectHelper->populateWithArray(
                $beefburgerWithPicklesData,
                $beefburgerWithPicklesModel->getData(),
                'ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface'
            );
            $items[] = $this->dataObjectProcessor->buildOutputDataArray(
                $beefburgerWithPicklesData,
                'ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface'
            );
        }
        $searchResults->setItems($items);
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \ProjectEight\ServiceContractsExampleWithApi\Api\Data\BeefburgerWithPicklesInterface $beefburgerWithPickles
    ) {
        try {
            $this->resource->delete($beefburgerWithPickles);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the BeefburgerWithPickles: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($beefburgerWithPicklesId)
    {
        return $this->delete($this->getById($beefburgerWithPicklesId));
    }
}
