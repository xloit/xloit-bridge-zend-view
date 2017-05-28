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

namespace Xloit\Bridge\Zend\View;

use Interop\Container\ContainerInterface;
use Xloit\Std\ArrayUtils;
use Zend\Mvc\Controller\PluginManager as ControllerPluginManager;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\View\Helper as ZendHelper;

/**
 * A {@link Module} class.
 *
 * @package Xloit\Bridge\Zend\View
 */
class Module
{
    /**
     * Return default zend-validator configuration for zend-mvc applications.
     *
     * @return array
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Xloit\DateTime\Exception\InvalidArgumentException
     * @throws \Xloit\Std\Exception\RuntimeException
     */
    public function getConfig()
    {
        return [
            'view_helpers' => [
                'aliases'   => [
                    'authentication' => Helper\Authentication::class,
                    'Authentication' => Helper\Authentication::class,
                    'config'         => Helper\Configuration::class,
                    'Config'         => Helper\Configuration::class,
                    'date'           => Helper\Date::class,
                    'Date'           => Helper\Date::class,
                    'filesize'       => Helper\FileSize::class,
                    'fileSize'       => Helper\FileSize::class,
                    'FileSize'       => Helper\FileSize::class,
                    'flashmessenger' => Helper\FlashMessenger::class,
                    'flashMessenger' => Helper\FlashMessenger::class,
                    'FlashMessenger' => Helper\FlashMessenger::class,
                    'gravatar'       => Helper\Gravatar::class,
                    'Gravatar'       => Helper\Gravatar::class,
                    'hasgravatar'    => Helper\HasGravatar::class,
                    'hasGravatar'    => Helper\HasGravatar::class,
                    'HasGravatar'    => Helper\HasGravatar::class,
                    'htmlclass'      => Helper\HtmlClass::class,
                    'htmlClass'      => Helper\HtmlClass::class,
                    'HtmlClass'      => Helper\HtmlClass::class,
                    'title'          => Helper\Title::class,
                    'Title'          => Helper\Title::class,
                    'url'            => Helper\Url::class,
                    'Url'            => Helper\Url::class
                ],
                'factories' => [
                    ZendHelper\HeadTitle::class  => function(ContainerInterface $container) {
                        /** @var ControllerPluginManager $pluginManager */
                        $pluginManager = $container->get(ControllerPluginManager::class);
                        $headTitle     = $pluginManager->get('headTitle');
                        $plugin        = new ZendHelper\HeadTitle();

                        $plugin((string) $headTitle);

                        return $plugin;
                    },
                    Helper\Configuration::class  => function(ContainerInterface $container) {
                        /** @var array $config */
                        $config = $container->get('Config');

                        return new Helper\Configuration($config);
                    },
                    Helper\Date::class           => function(ContainerInterface $container) {
                        $config = $container->get('Config');
                        $tz     = ArrayUtils::get($config, 'localization.timezone');

                        return new Helper\Date($tz);
                    },
                    Helper\Authentication::class => Service\AuthenticationHelperFactory::class,
                    Helper\FileSize::class       => InvokableFactory::class,
                    Helper\FlashMessenger::class => Service\FlashMessengerHelperFactory::class,
                    Helper\Gravatar::class       => InvokableFactory::class,
                    Helper\HasGravatar::class    => InvokableFactory::class,
                    Helper\HtmlClass::class      => Service\HtmlClassHelperFactory::class,
                    Helper\Title::class          => Service\TitleHelperFactory::class,
                    Helper\Url::class            => Service\UrlHelperFactory::class
                ]
            ]
        ];
    }
}
