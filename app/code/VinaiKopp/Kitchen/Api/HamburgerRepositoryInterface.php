<?php
/**
 * Example implementation of service contracts
 *
 * @link http://vinaikopp.com/2017/02/18/magento2_repositories_interfaces_and_webapi/
 *
 * Important! Here be timesinks!
 * There are a few gotchas here that are hard to debug if you get them wrong:
 *
 * DO NOT use PHP7 scalar argument types or return types if you want to hook this into the REST API!
 * Add PHPDoc annotations for all arguments and the return type to all methods!
 * Use Fully Qualified Class Names in the PHPDoc block!
 * The annotations are parsed by the Magento Framework to determine how to convert data to and from JSON or XML.
 * Class imports (that is, use statements above the class) are not applied!
 */

namespace VinaiKopp\Kitchen\Api;


use Magento\Framework\Api\SearchCriteriaInterface;
use VinaiKopp\Kitchen\Api\Data\HamburgerInterface;

interface HamburgerRepositoryInterface
{
	/**
	 * @param int $id
	 * @return \VinaiKopp\Kitchen\Api\Data\HamburgerInterface
	 * @throws \Magento\Framework\Exception\NoSuchEntityException
	 */
	public function getById($id);

	/**
	 * @param \VinaiKopp\Kitchen\Api\Data\HamburgerInterface $hamburger
	 * @return \VinaiKopp\Kitchen\Api\Data\HamburgerInterface
	 */
	public function save(HamburgerInterface $hamburger);

	/**
	 * @param \VinaiKopp\Kitchen\Api\Data\HamburgerInterface $hamburger
	 * @return void
	 */
	public function delete(HamburgerInterface $hamburger);

	/**
	 * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
	 * @return \VinaiKopp\Kitchen\Api\Data\HamburgerSearchResultInterface
	 */
	public function getList(SearchCriteriaInterface $searchCriteria);
}