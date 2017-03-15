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

namespace Mage2Kata\SkeletonModule\Test\Integration;

use Magento\Framework\App\DeploymentConfig;
use Magento\Framework\App\DeploymentConfig\Reader as DeploymentConfigReader;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Component\ComponentRegistrar;
use Magento\Framework\Module\ModuleList;
use Magento\TestFramework\ObjectManager;

class SkeletonModuleConfigTest extends \PHPUnit_Framework_TestCase
{
//	public function testNothing()
//	{
//		$this->markTestSkipped('Testing that PhpStorm and test framework is setup correctly');
//	}

	private $moduleName = 'Mage2Kata_SkeletonModule';

	/**
	 * Tests that
	 */
	public function testTheModuleIsRegistered()
	{
		$registrar = new ComponentRegistrar();
		$this->assertArrayHasKey(
			$this->moduleName,
			$registrar->getPaths( ComponentRegistrar::MODULE)
		);
	}

	public function testTheModuleIsConfiguredAndEnabledInTheTestEnvironment()
	{
		/** @var ObjectManager $objectManager */
		$objectManager = ObjectManager::getInstance();

		/** @var ModuleList $moduleList */
		$moduleList = $objectManager->create( ModuleList::class);

		$this->assertTrue( $moduleList->has( $this->moduleName), 'The module is not enabled in the test environment');
	}

	public function testTheModuleIsConfiguredAndEnabledInTheLiveEnvironment()
	{
		/** @var ObjectManager $objectManager */
		$objectManager = ObjectManager::getInstance();

		$dirList            = $objectManager->create( DirectoryList::class, ['root' => BP]);
		$configReader       = $objectManager->create( DeploymentConfigReader::class, ['dirList' => $dirList]);
		$deploymentConfig   = $objectManager->create( DeploymentConfig::class, ['reader' => $configReader]);

		/** @var ModuleList $moduleList */
		$moduleList = $objectManager->create( ModuleList::class, ['config' => $deploymentConfig]);


		$this->assertTrue( $moduleList->has( $this->moduleName), 'The module is not enabled in the live environment');
	}


}