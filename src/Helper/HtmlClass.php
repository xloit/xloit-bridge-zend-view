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

use Xloit\Bridge\Zend\Mvc\Controller\Plugin\HtmlClass as HtmlClassPlugin;
use Xloit\Bridge\Zend\Mvc\Controller\Plugin\Placeholder\HtmlClassContainer;

/**
 * A {@link HtmlClass} class.
 *
 * @package Xloit\Bridge\Zend\View\Helper
 */
class HtmlClass extends AbstractHelper
{
    /**
     * Plugin container.
     *
     * @var HtmlClassPlugin
     */
    protected $pluginContainer;

    /**
     * Constructor to prevent {@link HtmlClass} from being loaded more than once.
     *
     * @param HtmlClassPlugin $pluginContainer
     */
    public function __construct(HtmlClassPlugin $pluginContainer)
    {
        $this->pluginContainer = $pluginContainer;
    }

    /**
     *
     *
     * @param string $key
     * @param string $value
     * @param string $setType
     *
     * @return $this|HtmlClassContainer
     */
    public function __invoke($key = null, $value = null, $setType = null)
    {
        if ($key) {
            if (null === $setType) {
                $setType = $this->pluginContainer->getDefaultAttachOrder();
            }

            if ($value === null) {
                return $this->getContainer($key);
            }

            if ($setType === HtmlClassContainer::SET) {
                $this->set($key, $value);
            } elseif ($setType === HtmlClassContainer::PREPEND) {
                $this->prepend($key, $value);
            } else {
                $this->append($key, $value);
            }
        }

        return $this;
    }

    /**
     * Retrieve a placeholder container.
     *
     * @param string $key
     *
     * @return HtmlClassContainer
     */
    public function getContainer($key)
    {
        return $this->pluginContainer->getContainer($key);
    }

    /**
     * Set html class.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function set($key, $value)
    {
        $this->getContainer($key)->set($value);

        return $this;
    }

    /**
     * Prepend html class.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function prepend($key, $value)
    {
        $this->getContainer($key)->prepend($value);

        return $this;
    }

    /**
     * Append html class.
     *
     * @param string $key
     * @param string $value
     *
     * @return $this
     */
    public function append($key, $value)
    {
        $this->getContainer($key)->append($value);

        return $this;
    }

    /**
     * Set the container for an item in the registry.
     *
     * @param string             $key
     * @param HtmlClassContainer $container
     *
     * @return $this
     */
    public function setContainer($key, HtmlClassContainer $container)
    {
        $this->pluginContainer->setContainer($key, $container);

        return $this;
    }

    /**
     * Does a particular container exist?
     *
     * @param string $key
     *
     * @return bool
     */
    public function containerExists($key)
    {
        return $this->pluginContainer->containerExists($key);
    }

    /**
     * Create a new container.
     *
     * @param string $key
     * @param array  $value
     *
     * @return HtmlClassContainer
     */
    public function createContainer($key, array $value = [])
    {
        return $this->pluginContainer->createContainer($key, $value);
    }

    /**
     * Delete a container.
     *
     * @param string $key
     *
     * @return bool
     */
    public function deleteContainer($key)
    {
        return $this->pluginContainer->deleteContainer($key);
    }

    /**
     *
     *
     * @param string $key
     *
     * @return string
     */
    public function render($key)
    {
        $escapeHtmlAttr = $this->getViewPlugin('escapeHtmlAttr');
        $container      = $this->getContainer($key);
        $collections    = array_map($escapeHtmlAttr, $container->getArrayCopy());

        return implode($container->getSeparator(), $collections);
    }
}
