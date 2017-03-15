<?php
/**
 * ProjectEight
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this module to newer
 * versions in the future. If you wish to customize this module for your
 * needs please contact ProjectEight for more information.
 *
 * @category    ProjectEight
 * @package     m2devbox
 * @copyright   Copyright (c) 2017 ProjectEight
 * @author      ProjectEight
 *
 */

namespace Mage2Kata\Interceptor\Plugin;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\Area;
use Magento\TestFramework\App\State;
use Magento\TestFramework\Interception\PluginList;
use Magento\TestFramework\ObjectManager;

class CustomerRepositoryPluginTest extends \PHPUnit_Framework_TestCase
{
//	public function testNothing()
//	{
//		$this->assertTrue( true);
//	}

	public function testTheModuleInterceptsCallsToTheCustomerRepository()
	{
		/** @var ObjectManager $objectManager */
		$objectManager = ObjectManager::getInstance();

		/** @var PluginList $pluginList */
		$pluginList = $objectManager->create( PluginList::class );

		// If there is no configuration for this plugin type, return an empty array
		$pluginInfo = $pluginList->get( CustomerRepositoryInterface::class, [ ] );

		// 'mage2kata_interceptor' is the name of the plugin and needs to be unique
		$this->assertSame( CustomerRepositoryPlugin::class, $pluginInfo['mage2kata_interceptor']['instance'] );
	}

	public function testTheModuleInterceptsCallsToTheCustomerRepositoryInWebApiScopeOnly()
	{
		/** @var ObjectManager $objectManager */
		$objectManager = ObjectManager::getInstance();

		/** @var State $appArea */
		$appArea = $objectManager->get( State::class);
		$appArea->setAreaCode( Area::AREA_WEBAPI_REST);

		/** @var PluginList $pluginList */
		$pluginList = $objectManager->create( PluginList::class );

		// If there is no configuration for this plugin type, return an empty array
		$pluginInfo = $pluginList->get( CustomerRepositoryInterface::class, [ ] );

		// 'mage2kata_interceptor' is the name of the plugin and needs to be unique
		$this->assertSame( CustomerRepositoryPlugin::class, $pluginInfo['mage2kata_interceptor']['instance'] );
	}
}