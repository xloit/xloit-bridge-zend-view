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

use Zend\View\Helper\Gravatar as ZendGravatar;

/**
 * A {@link Gravatar} class.
 *
 * @package Xloit\Bridge\Zend\View\Helper
 */
class Gravatar extends ZendGravatar
{
    /**
     * Returns an avatar from gravatar's service.
     *
     * $options may include the following:
     * - 'img_size' int height of img to return.
     * - 'default_img' string img to return if email address has not found.
     * - 'rating' string rating parameter for avatar.
     * - 'secure' bool load from the SSL or Non-SSL location.
     *
     * @link  http://pl.gravatar.com/site/implement/url
     *
     * @param string|null $email      Email address.
     * @param null|array  $options    Options.
     * @param array       $attributes Attributes for image tag (title, alt etc.).
     *
     * @return $this
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
            && is_callable(
                [
                    $this->view->userIdentity(),
                    'getEmail'
                ]
            )
        ) {
            /** @noinspection PhpUndefinedMethodInspection */
            $email = (string) $this->view->userIdentity()->getEmail();
        }

        return parent::__invoke($email, $options, $attributes);
    }

    /**
     * Get avatar url (including size, rating and default image options).
     *
     * @return string
     */
    public function getSourceUrl()
    {
        return $this->getAvatarUrl();
    }

    /**
     * Indicates whether the current email has gravatar.
     *
     * @return string
     */
    public function isExists()
    {
        return $this->getEmail() ? $this->validateGravatar($this->getEmail()) : false;
    }

    /**
     * Validate if has gravatar.
     *
     * @param string $email
     *
     * @return bool
     */
    protected function validateGravatar($email)
    {
        /** @noinspection PhpUsageOfSilenceOperatorInspection */
        $headers = $email ? @get_headers('http://www.gravatar.com/avatar/' . md5($email) . '?d=404') : false;

        if (!$headers) {
            return false;
        }

        /** @var array $headers */
        return strpos($headers[0], '200') !== false;
    }
}
