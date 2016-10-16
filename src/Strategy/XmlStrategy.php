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

namespace Xloit\Bridge\Zend\View\Strategy;

use Xloit\Bridge\Zend\View\Model\XmlModel;
use Zend\View\Model\ModelInterface;

/**
 * A {@link XmlStrategy} class.
 *
 * @package Xloit\Bridge\Zend\View\Strategy
 */
class XmlStrategy extends AbstractStrategy
{
    /**
     * Indicates whether the given model is valid.
     *
     * @param ModelInterface $model
     *
     * @return bool
     */
    protected function isValidModel(ModelInterface $model)
    {
        return $model instanceof XmlModel;
    }
}
