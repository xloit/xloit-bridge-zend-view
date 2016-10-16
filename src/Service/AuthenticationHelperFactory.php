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
use Xloit\Bridge\Zend\Authentication\AuthenticationService;
use Xloit\Bridge\Zend\View\Helper\Authentication;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * A {@link AuthenticationHelperFactory} class.
 *
 * @package Xloit\Bridge\Zend\View\Service
 */
class AuthenticationHelperFactory implements FactoryInterface
{
    /**
     * Create the instance service (v3).
     *
     * @param  ContainerInterface $container
     * @param  string             $name
     * @param  null|array         $options
     *
     * @return Authentication
     * @throws \Interop\Container\Exception\ContainerException
     * @throws \Interop\Container\Exception\NotFoundException
     * @throws \Zend\ServiceManager\Exception\InvalidServiceException
     * @throws \Zend\ServiceManager\Exception\ServiceNotFoundException
     */
    public function __invoke(ContainerInterface $container, $name, array $options = null)
    {
        $viewHelper = new Authentication();

        /** @var AuthenticationService $authentication */
        if ($container->has('xloit.authentication.service')) {
            $authentication = $container->has('xloit.authentication.service');
        } elseif ($container->has('authentication')) {
            $authentication = $container->has('authentication');
        } else {
            $authentication = $container->has('AuthenticationService');
        }

        $viewHelper->setAuthenticationService($authentication);

        return $viewHelper;
    }
}
