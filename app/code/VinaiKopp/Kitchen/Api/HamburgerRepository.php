<?php

namespace VinaiKopp\Kitchen\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\NoSuchEntityException;
use VinaiKopp\Kitchen\Api\Data\HamburgerInterface;
use VinaiKopp\Kitchen\Api\Data\HamburgerSearchResultInterface;
use VinaiKopp\Kitchen\Api\Data\HamburgerSearchResultInterfaceFactory;
use VinaiKopp\Kitchen\Model\ResourceModel\Hamburger\Collection as HamburgerCollectionFactory;
use VinaiKopp\Kitchen\Model\ResourceModel\Hamburger\Collection;

class HamburgerRepository implements HamburgerRepositoryInterface
{
	/**
	 * @var HamburgerFactory
	 */
	protected $hamburgerFactory;

	/**
	 * @var HamburgerCollectionFactory
	 */
	private $hamburgerCollectionFactory;

	/**
	 * @var HamburgerSearchResultInterfaceFactory
	 */
	private $hamburgerSearchResultInterfaceFactory;

	/**
	 * HamburgerRepository constructor.
	 *
	 * @param HamburgerFactory $hamburgerFactory
	 */
	public function __construct(
		HamburgerFactory $hamburgerFactory,
		HamburgerCollectionFactory $hamburgerCollectionFactory,
		HamburgerSearchResultInterfaceFactory $hamburgerSearchResultInterfaceFactory
	)
	{
		$this->hamburgerFactory = $hamburgerFactory;
		$this->hamburgerCollectionFactory = $hamburgerCollectionFactory;
		$this->hamburgerSearchResultInterfaceFactory = $hamburgerSearchResultInterfaceFactory;
	}

	/**
	 * @param int $id
	 *
	 * @return HamburgerInterface
	 * @throws NoSuchEntityException
	 */
	public function getById( $id )
	{
		/** @var HamburgerInterface $hamburger */
		$hamburger = $this->hamburgerFactory->create();
		$hamburger->getResource()->load($hamburger, $id);
		if(!$hamburger->getId()) {
			throw new NoSuchEntityException(__('Cannot find hamburger with ID "%1"', $id));
		}
		return $hamburger;
	}

	/**
	 * @param HamburgerInterface $hamburger
	 *
	 * @return HamburgerInterface
	 */
	public function save( HamburgerInterface $hamburger)
	{
		$hamburger->getResource()->save($hamburger);

		return $hamburger;
	}

	/**
	 * @param HamburgerInterface $hamburger
	 */
	public function delete( HamburgerInterface $hamburger )
	{
		$hamburger->getResource()->delete($hamburger);
	}

	public function getList( SearchCriteriaInterface $searchCriteria )
	{
		$collection = $this->collectionFactory->create();

		$this->addFiltersToCollection($searchCriteria, $collection);
		$this->addSortOrdersToCollection($searchCriteria, $collection);
		$this->addPagingToCollection($searchCriteria, $collection);

		$collection->load();

		return $this->buildSearchResult($searchCriteria, $collection);
	}

	private function addFiltersToCollection( SearchCriteriaInterface $searchCriteria, Collection $collection )
	{
		foreach ( $searchCriteria->getFilterGroups() as $filterGroup ) {
			$fields = $conditions = [];
			foreach ( $filterGroup->getFilters() as $filter ) {
				$fields[] = $filter->getField();
				$conditions[] = [$filter->getConditionType() => $filter->getValue()];
			}
			$collection->addFieldToFilter($fields, $conditions);
		}
	}

	private function addSortOrdersToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
	{
		foreach ((array) $searchCriteria->getSortOrders() as $sortOrder) {
			$direction = $sortOrder->getDirection() == SortOrder::SORT_ASC ? 'asc' : 'desc';
			$collection->addOrder($sortOrder->getField(), $direction);
		}
	}

	private function addPagingToCollection(SearchCriteriaInterface $searchCriteria, Collection $collection)
	{
		$collection->setPageSize($searchCriteria->getPageSize());
		$collection->setCurPage($searchCriteria->getCurrentPage());
	}

	private function buildSearchResult(SearchCriteriaInterface $searchCriteria, Collection $collection)
	{
		$searchResults = $this->searchResultFactory->create();

		$searchResults->setSearchCriteria($searchCriteria);
		$searchResults->setItems($collection->getItems());
		$searchResults->setTotalCount($collection->getSize());

		return $searchResults;
	}
}
