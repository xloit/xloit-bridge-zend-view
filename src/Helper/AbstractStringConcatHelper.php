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

use Xloit\Bridge\Zend\Mvc\Controller\Plugin\AbstractStringConcatPlugin;
use Zend\View\Helper\Placeholder\Container;

/**
 * An {@link AbstractStringConcatHelper} abstract class.
 *
 * @abstract
 * @package Xloit\Bridge\Zend\View\Helper
 */
abstract class AbstractStringConcatHelper extends AbstractTextHelper
{
    /**
     * Plugin container.
     *
     * @var AbstractStringConcatPlugin
     */
    protected $pluginContainer;

    /**
     *
     * @param string $value
     * @param string $setType
     *
     * @return static
     */
    public function __invoke($value = null, $setType = null)
    {
        if ($value) {
            if (null === $setType) {
                $setType = $this->pluginContainer->getDefaultAttachOrder();
            }

            if ($setType === Container::SET) {
                $this->set($value);
            } elseif ($setType === Container::PREPEND) {
                $this->prepend($value);
            } else {
                $this->append($value);
            }
        }

        return $this;
    }

    /**
     * Set data value.
     *
     * @param string $value
     *
     * @return static
     */
    public function set($value)
    {
        $this->pluginContainer->set((string) $value);

        return $this;
    }

    /**
     * Prepend data.
     *
     * @param string $value
     *
     * @return static
     */
    public function prepend($value)
    {
        $this->pluginContainer->prepend((string) $value);

        return $this;
    }

    /**
     * Append data.
     *
     * @param string $value
     *
     * @return static
     */
    public function append($value)
    {
        $this->pluginContainer->append((string) $value);

        return $this;
    }

    /**
     *
     *
     * @return AbstractStringConcatPlugin
     */
    public function getPluginContainer()
    {
        return $this->pluginContainer;
    }

    /**
     *
     *
     * @param AbstractStringConcatPlugin $pluginContainer
     *
     * @return static
     */
    public function setPluginContainer(AbstractStringConcatPlugin $pluginContainer)
    {
        $this->pluginContainer = $pluginContainer;

        return $this;
    }

    /**
     * Set separator.
     *
     * @param string $separator
     *
     * @return static
     */
    public function setSeparator($separator)
    {
        $this->pluginContainer->setSeparator($separator);

        return $this;
    }

    /**
     * Get value data.
     *
     * @return string
     */
    public function getValue()
    {
        return $this->pluginContainer->getValue();
    }

    /**
     * Get data as string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }

    /**
     *
     *
     * @return string
     */
    public function render()
    {
        $itemCallback = $this->getTitleItemCallback();
        $container    = $this->pluginContainer->getContainer();
        $collections  = $container->getArrayCopy();
        $items        = [];

        foreach ($collections as $item) {
            $items[] = $itemCallback($item);
        }

        $separator = $container->getSeparator();

        return implode($separator, $items);
    }

    /**
     * Create and return a callback for normalizing title items.
     * If translation is not enabled, or no translator is present, returns a callable that simply returns the provided
     * item; otherwise, returns a callable that returns a translation of the provided item.
     *
     * @return callable
     */
    private function getTitleItemCallback()
    {
        if (!$this->isTranslatorEnabled() || !$this->hasTranslator()) {
            return function($item) {
                return $item;
            };
        }

        $translator = $this->getTranslator();
        $textDomain = $this->getTranslatorTextDomain();

        return function($item) use ($translator, $textDomain) {
            return $translator->translate($item, $textDomain);
        };
    }
}
