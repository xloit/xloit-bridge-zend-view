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

use Xloit\Std\ArrayUtils;
use Zend\View\Helper\AbstractHelper;

/**
 * A {@link Configuration} class.
 *
 * @package Xloit\Bridge\Zend\View\Helper
 */
class Configuration extends AbstractHelper
{
    /**
     *
     *
     * @var array
     */
    protected $config;

    /**
     * Constructor to prevent {@link Locale} from being loaded more than once.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     *
     *
     * @param string $path
     * @param mixed  $default
     *
     * @return static|mixed
     * @throws \Xloit\Std\Exception\RuntimeException
     */
    public function __invoke($path = null, $default = null)
    {
        if ($path === null) {
            return $this;
        }

        return $this->get($path, $default);
    }

    /**
     *
     *
     * @param string $path
     * @param mixed  $default
     *
     * @return mixed
     * @throws \Xloit\Std\Exception\RuntimeException
     */
    public function get($path, $default = null)
    {
        return ArrayUtils::get($this->config, $path, $default);
    }

    /**
     *
     *
     * @return array
     */
    public function getConfig()
    {
        return $this->config;
    }
}
