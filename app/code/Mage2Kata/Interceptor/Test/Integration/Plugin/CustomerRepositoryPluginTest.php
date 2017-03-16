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
	protected $pluginModuleId = 'mage2kata_interceptor';

	/** @var ObjectManager $objectManager */
	protected $objectManager;

	protected function setup()
	{
		/** @var ObjectManager $objectManager */
		$this->objectManager = ObjectManager::getInstance();

		// This is the name of the plugin and needs to be unique
		$this->pluginModuleId = 'mage2kata_interceptor';
	}

	protected function tearDown()
	{
		$this->setArea( null);
	}

	/**
	 * @param string $areaCode
	 */
	protected function setArea( $areaCode )
	{
		/** @var State $appArea */
		$appArea = $this->objectManager->get( State::class );
		$appArea->setAreaCode( $areaCode );
	}

	/**
	 * @return array[]
	 */
	protected function getCustomerRepositoryPluginInfo()
	{
		$pluginList = $this->objectManager->create( PluginList::class );
		// If there is no configuration for this plugin type, return an empty array
		$pluginInfo = $pluginList->get( CustomerRepositoryInterface::class, [ ] );

		return $pluginInfo;
	}

	/**
	 * Test assumes that di.xml is in Mage2Kata/Interceptor/etc/di.xml
	 */
//	public function testTheModuleInterceptsCallsToTheCustomerRepository()
//	{
//		$pluginInfo = $this->getCustomerRepositoryPluginInfo();
//
//		// '$this->pluginModuleId' is the name of the plugin and needs to be unique
//		$this->assertSame( CustomerRepositoryPlugin::class, $pluginInfo[ $this->pluginModuleId ]['instance'] );
//	}

	public function testTheModuleInterceptsCallsToTheCustomerRepositoryInWebApiRestScopeOnly()
	{
		$this->setArea( Area::AREA_WEBAPI_REST );

		$pluginInfo = $this->getCustomerRepositoryPluginInfo();

		// '$this->pluginModuleId' is the name of the plugin and needs to be unique
		$this->assertSame( CustomerRepositoryPlugin::class, $pluginInfo[ $this->pluginModuleId ]['instance'] );
	}

	public function testTheModuleDoesNotInterceptCallsToTheCustomerRepositoryInGlobalScope( )
	{
		$this->setArea( Area::AREA_GLOBAL);
		$this->assertArrayNotHasKey( $this->pluginModuleId, $this->getCustomerRepositoryPluginInfo());
	}
}