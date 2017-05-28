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

use Xloit\Bridge\Zend\Authentication\AuthenticationServiceAwareInterface;
use Xloit\Bridge\Zend\Authentication\AuthenticationServiceAwareTrait;
use Xloit\Bridge\Zend\View\Exception;
use Zend\View\Helper\AbstractHelper;

/**
 * An {@link Authentication} class
 *
 * @package Xloit\Bridge\Zend\View\Helper
 */
class Authentication extends AbstractHelper implements AuthenticationServiceAwareInterface
{
    use AuthenticationServiceAwareTrait;

    /**
     *
     * @return $this
     */
    public function __invoke()
    {
        return $this;
    }

    /**
     * Proxy to container methods.
     *
     * @param string $method
     * @param array  $args
     *
     * @return mixed
     * @throws \Xloit\Bridge\Zend\View\Exception\BadMethodCallException
     */
    public function __call($method, $args)
    {
        $authService = $this->getAuthenticationService();

        if (method_exists($authService, $method)) {
            $result = call_user_func_array(
                [
                    $authService,
                    $method
                ], $args
            );

            if ($result === $authService) {
                // If the container is returned, we really want the current object
                return $this;
            }

            return $result;
        }

        throw new Exception\BadMethodCallException(sprintf('Method "%s" does not exist', $method));
    }
}
