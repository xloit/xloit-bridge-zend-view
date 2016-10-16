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

use Zend\View\Helper\AbstractHelper as AbstractViewHelper;

/**
 * An {@link AbstractHelper} abstract class.
 *
 * @abstract
 * @package Xloit\Bridge\Zend\View\Helper
 */
abstract class AbstractHelper extends AbstractViewHelper
{
    /**
     *
     *
     * @param string $plugin
     *
     * @return mixed
     */
    protected function getViewPlugin($plugin)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        return $this->getView()->plugin($plugin);
    }
}
