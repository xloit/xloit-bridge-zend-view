<?php
/**
 * This source file is part of Xloit project.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the MIT License that is bundled with this package in the file LICENSE.
 * It is also available through the world-wide-web at this URL:
 * <http://www.opensource.org/licenses/mit-license.php>
 * If you did not receive a copy of the license and are unable to obtain it through the world-wide-web,
 * please send an email to <license@xloit.com> so we can send you a copy immediately.
 *
 * @license   MIT
 * @link      http://xloit.com
 * @copyright Copyright (c) 2016, Xloit. All rights reserved.
 */

namespace Xloit\Bridge\Zend\View\Service;

use Interop\Container\ContainerInterface;
use Xloit\Bridge\Zend\Mvc\Controller\Plugin\Title as ControllerPluginTitle;
use Xloit\Bridge\Zend\View\Helper\Title;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * An {@link AbstractTitleHelperFactory} class.
 *
 * @package Xloit\Bridge\Zend\View\Service
 */
class TitleHelperFactory implements FactoryInterface
{
    /**
     * Create the instance service (v3).
     *
     * @param ContainerInterface $container
     * @param string             $name
     * @param null|array         $options
     *
     * @return Title
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Zend\ServiceManager\Exception\InvalidServiceException
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        /** @var $controllerPluginManager \Zend\ServiceManager\AbstractPluginManager */
        $controllerPluginManager = $container->get('ControllerPluginManager');
        /** @var $controllerPlugin ControllerPluginTitle */
        $controllerPlugin = $controllerPluginManager->get($this->getControllerPluginName());

        return $this->createPlugin($controllerPlugin);
    }

    /**
     *
     *
     * @return string
     */
    public function getControllerPluginName()
    {
        return ControllerPluginTitle::class;
    }

    /**
     *
     *
     * @param ControllerPluginTitle $plugin
     *
     * @return Title
     */
    public function createPlugin(ControllerPluginTitle $plugin)
    {
        $viewPlugin = new Title();

        $viewPlugin->setPluginContainer($plugin);

        return $viewPlugin;
    }
}
