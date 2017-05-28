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
use Xloit\Bridge\Zend\View\Helper\Url;
use Zend\Router\RouteMatch;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * An {@link UrlHelperFactory} class.
 *
 * @package Xloit\Bridge\Zend\View\Service
 */
class UrlHelperFactory implements FactoryInterface
{
    /**
     * Create the instance service (v3).
     *
     * @param ContainerInterface $container
     * @param string             $name
     * @param null|array         $options
     *
     * @return Url
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Zend\View\Exception\InvalidArgumentException
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $routerName = PHP_SAPI === 'cli' ? 'HttpRouter' : 'Router';
        $router     = $container->get($routerName);
        $viewHelper = new Url();

        /** @var \Zend\Router\RouteStackInterface $router */
        $viewHelper->setRouter($router);

        $routeMatch = $container->get('application')->getMvcEvent()->getRouteMatch();

        if ($routeMatch instanceof RouteMatch) {
            $viewHelper->setRouteMatch($routeMatch);
        }

        return $viewHelper;
    }
}
