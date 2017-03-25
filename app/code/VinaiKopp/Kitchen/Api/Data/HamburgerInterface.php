<?php
/**
 * The return type interfaces that all reside inside the Api\Data namespace/directory indicates that
 * they do not contain any business logic. They are simply “bags of data”.
 *
 * This is a data model.
 */
namespace VinaiKopp\Kitchen\Api\Data;


use Magento\Framework\Api\ExtensibleDataInterface;

interface HamburgerInterface extends ExtensibleDataInterface
{
	/**
	 * @return int
	 */
	public function getId();

	/**
	 * @param int $id
	 * @return void
	 */
	public function setId($id);

	/**
	 * @return string
	 */
	public function getName();

	/**
	 * @param string $name
	 * @return void
	 */
	public function setName($name);

	/**
	 * @return \VinaiKopp\Kitchen\Api\Data\IngredientInterface[]
	 */
	public function getIngredients();

	/**
	 * @param \VinaiKopp\Kitchen\Api\Data\IngredientInterface[] $ingredients
	 * @return void
	 */
	public function setIngredients(array $ingredients);

	/**
	 * @return string[]
	 */
	public function getImageUrls();

	/**
	 * @param string[] $urls
	 * @return void
	 */
	public function setImageUrls(array $urls);

	/**
	 * @return \VinaiKopp\Kitchen\Api\Data\HamburgerSearchResultInterface|null
	 */
	public function getExtensionAttributes();

	/**
	 * @param \VinaiKopp\Kitchen\Api\Data\HamburgerSearchResultInterface $extensionAttributes
	 *
*@return void
	 */
	public function setExtensionAttributes( HamburgerSearchResultInterface $extensionAttributes);
}