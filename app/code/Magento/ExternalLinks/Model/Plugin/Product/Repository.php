<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\ExternalLinks\Model\Plugin\Product;

use Magento\Catalog\Api\Data\ProductExtensionFactory;
use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\EntityManager\EntityManager;
use Magento\ExternalLinks\Api\Data\ExternalLinkInterface;
use Magento\ExternalLinks\Api\ExternalLinksProviderInterface;

/**
 * Class Repository
 * @package Magento\ExternalLinks\Model\Plugin\Product
 */
class Repository
{
    /** @var ProductExtensionFactory */
    private $productExtensionFactory;

    /** @var ProductInterface  */
    private $currentProduct;

    /** @var  EntityManager */
    private $entityManager;

    /** @var ExternalLinksProviderInterface */
    private $externalLinksProvider;

    /**
     * Repository constructor.
     * @param ProductExtensionFactory $productExtensionFactory
     * @param EntityManager $entityManager
     */
    public function __construct(
        ProductExtensionFactory $productExtensionFactory,
        EntityManager $entityManager,
        ExternalLinksProviderInterface $externalLinksProvider
    )
    {
        $this->productExtensionFactory = $productExtensionFactory;
        $this->entityManager = $entityManager;
        $this->externalLinksProvider = $externalLinksProvider;
    }

    /**
     * Add Social Links to product extension attributes
     *
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $subject
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResults
     */
    public function afterGetList
    (
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Framework\Api\SearchResults $searchResult
    ) {
        /** @var \Magento\Catalog\Api\Data\ProductInterface $product */
        foreach ($searchResult->getItems() as $product) {
            $this->addExternalLinksToProduct($product);
        }

        return $searchResult;
    }

    /**
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @return void
     */
    public function beforeSave
    (
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $product
    ) {
        $this->currentProduct = $product;
    }

    /**
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $subject
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return \Magento\Catalog\Api\Data\ProductInterface
     */
    public function afterGet
    (
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $product
    ) {
        $this->addExternalLinksToProduct($product);
        return $product;
    }

    /**
     * Compare old and new links. And if old links has the same as new one -> delete them
     *
     * @param array $newLinks
     * @param array $oldLinks
     * @throws \Exception
     */
    private function cleanOldLinks(array $newLinks, array $oldLinks)
    {
        /** @var ExternalLinkInterface $link */
        foreach($newLinks as $link) {
            /** @var ExternalLinkInterface $oldLink */
            foreach($oldLinks as $oldLink) {
                if ($oldLink->getLinkType() === $link->getLinkType()) {
                    $this->entityManager->delete($oldLink);
                }
            }
        }
    }

    /**
     * @param \Magento\Catalog\Api\ProductRepositoryInterface $subject
     * @param ProductInterface $product
     * @throws \Exception
     * @return self
     */
    public function afterSave
    (
        \Magento\Catalog\Api\ProductRepositoryInterface $subject,
        \Magento\Catalog\Api\Data\ProductInterface $product
    ) {
        if ($this->currentProduct !== null) {
            /** @var ProductInterface $previosProduct */
            $extensionAttributes = $this->currentProduct->getExtensionAttributes();

            if ($extensionAttributes && $extensionAttributes->getExternalLinks()) {
                /** @var ExternalLinkInterface $externalLink */
                $externalLinks = $extensionAttributes->getExternalLinks();
                $oldExternalLinks = $product->getExtensionAttributes()->getExternalLinks();

                if (is_array($externalLinks)) {
                    $this->cleanOldLinks($externalLinks, $oldExternalLinks);
                    /** @var ExternalLinkInterface $link */
                    foreach($externalLinks as $link) {
                        $link->setProductId($product->getId());
                        $this->entityManager->save($link);
                    }
                }
            }

            $this->currentProduct = null;
        }

        return $product;
    }
    
    /**
     * @param \Magento\Catalog\Api\Data\ProductInterface $product
     * @return self
     */
    private function addExternalLinksToProduct(\Magento\Catalog\Api\Data\ProductInterface $product)
    {
        $extensionAttributes = $product->getExtensionAttributes(); 

        if (empty($extensionAttributes)) {
            $extensionAttributes = $this->productExtensionFactory->create();
        }
//	    $externalLinks = $this->externalLinksProvider->getLinks($product->getId());
	    $externalLinks = $this->getNaughtyLinksUsingObjectManager();
        $extensionAttributes->setExternalLinks($externalLinks);
        $product->setExtensionAttributes($extensionAttributes);

        return $this;
    }

//	public function getNaughtyLinksUsingObjectManager()
//	{
//		$dynamicProductData = [
//			'id' => 1,
//			'sku' => 'first-product',
//			'ebay_link' => 'http://ebay.com/some-address-1',
//			'amazon_link' => 'http://amazon.com/some-address-1'
//		];
//
//		/** @var \Magento\TestFramework\ObjectManager $objectManager */
//		$objectManager = \Magento\Framework\App\ObjectManager::getInstance();
//
//		/** @var ExternalLinkInterface $externalLink */
//		$externalLink = $objectManager->create(\Magento\ExternalLinks\Model\ExternalLink::class);
//		$externalLink->setLink($dynamicProductData['ebay_link']);
//		$externalLink->setProductId($dynamicProductData['id']);
//		$externalLink->setLinkType('ebay');
//
//		$externalLinks[] = $externalLink;
//
//		$externalLink = $objectManager->create(\Magento\ExternalLinks\Model\ExternalLink::class);
//		$externalLink->setLink($dynamicProductData['amazon_link']);
//		$externalLink->setProductId($dynamicProductData['id']);
//		$externalLink->setLinkType('amazon');
//
//		$externalLinks[] = $externalLink;
//
//		return $externalLinks;
//	}
}