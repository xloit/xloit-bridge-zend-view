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

namespace Xloit\Bridge\Zend\View\Helper;

use Xloit\Bridge\Zend\Uri\Helper\UrlTrait;
use Zend\View\Helper\Url as ZendUrl;

/**
 * An {@link Url} class
 *
 * @package Xloit\Bridge\Zend\View\Helper
 */
class Url extends ZendUrl
{
    use UrlTrait;

    /**
     * Generates an url given the name of a route.
     *
     * @see  \Zend\Router\RouteInterface::assemble()
     *
     * @param string $name
     * @param array  $params
     * @param array  $options
     * @param bool   $reuseMatchedParams
     *
     * @return string
     * @throws \Xloit\Bridge\Zend\Uri\Exception\RuntimeException
     * @throws \Zend\View\Exception\InvalidArgumentException
     * @throws \Zend\View\Exception\RuntimeException
     */
    public function __invoke($name = null, $params = [], $options = [], $reuseMatchedParams = false)
    {
        return parent::__invoke($this->generateRouteUrl($name), $params, $options, $reuseMatchedParams);
    }

    /**
     * Generates a URL based on a route
     *
     * @return \Zend\Router\RouteMatch
     */
    public function getRouteMatch()
    {
        return $this->routeMatch;
    }
}
