<?php
/**
 * This source file is part of Virtupeer project.
 *
 * @link      https://virtupeer.com
 * @copyright Copyright (c) 2016, Virtupeer. All rights reserved.
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
     * @throws \Interop\Container\Exception\NotFoundException
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \Xloit\Std\Exception\RuntimeException
     * @throws \Xloit\DateTime\Exception\InvalidArgumentException
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
