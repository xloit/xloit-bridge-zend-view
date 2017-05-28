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
use Xloit\Bridge\Zend\ServiceManager\AbstractFactory;

/**
 * An {@link AbstractViewStrategyFactory} abstract class.
 *
 * @abstract
 * @package Xloit\Bridge\Zend\View\Service
 */
abstract class AbstractViewStrategyFactory extends AbstractFactory
{
    /**
     * Create the instance service (v3).
     *
     * @param ContainerInterface $container
     * @param string             $name
     * @param null|array         $options
     *
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        /** @var $viewRenderer \Zend\View\Renderer\RendererInterface */
        $viewRenderer = $container->get('ViewRenderer');
        $className    = $this->getInstanceClass();

        return new $className($viewRenderer);
    }

    /**
     *
     *
     * @return string
     */
    abstract public function getInstanceClass();
}
