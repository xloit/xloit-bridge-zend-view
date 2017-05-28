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

/**
 * A {@link HasGravatar} class.
 *
 * @package Xloit\Bridge\Zend\View\Helper
 */
class HasGravatar extends Gravatar
{
    /**
     * User email has Gravatar.
     *
     * @param string|null $email      Email address.
     * @param null|array  $options    Options.
     * @param array       $attributes Attributes for image tag (title, alt etc.).
     *
     * @return bool
     */
    public function __invoke($email = null, $options = [], $attributes = [])
    {
        /** @noinspection PhpUndefinedMethodInspection */
        if (!$email
            && is_callable(
                [
                    $this->view,
                    'userIdentity'
                ]
            )
        ) {
            /** @noinspection PhpUndefinedMethodInspection */
            $email = (string) $this->view->userIdentity()->getEmail();
        }

        if (!$email) {
            return false;
        }

        return $this->validateGravatar($email);
    }
} 
