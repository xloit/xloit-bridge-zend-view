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

use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger as PluginFlashMessenger;
use Zend\View\Model\ViewModel;
use Zend\View\Renderer\PhpRenderer;

/**
 * A {@link FlashMessenger} class
 *
 * @package Xloit\Bridge\Zend\View\Helper
 */
class FlashMessenger extends AbstractTextHelper
{
    /**
     *
     *
     * @var PhpRenderer
     */
    protected $renderer;

    /**
     *
     *
     * @var string
     */
    protected $layoutPrefix = 'layout/partial/messages/';

    /**
     *
     *
     * @var PluginFlashMessenger
     */
    protected $flashMessenger;

    /**
     * Default namespaces.
     *
     * @var array
     */
    protected $namespaces = [
        PluginFlashMessenger::NAMESPACE_ERROR,
        PluginFlashMessenger::NAMESPACE_SUCCESS,
        PluginFlashMessenger::NAMESPACE_INFO,
        PluginFlashMessenger::NAMESPACE_WARNING,
        PluginFlashMessenger::NAMESPACE_DEFAULT
    ];

    /**
     * Flash Messenger View Helper.
     *
     * @param string $namespace
     * @param bool   $includeCurrent
     * @param bool   $forceClear
     *
     * @return string|$this
     * @throws \Zend\View\Exception\DomainException
     * @throws \Zend\View\Exception\InvalidArgumentException
     * @throws \Zend\View\Exception\RuntimeException
     */
    public function __invoke($namespace = null, $includeCurrent = false, $forceClear = true)
    {
        if (null === $namespace) {
            return $this;
        }

        return $this->renderNamespace($namespace, $includeCurrent, $forceClear);
    }

    /**
     * Return the layout path prefix.
     *
     * @return string
     */
    public function getLayoutPrefix()
    {
        return $this->layoutPrefix;
    }

    /**
     * Sets the layout path prefix.
     *
     * @param string $layoutPrefix
     *
     * @return $this
     */
    public function setLayoutPrefix($layoutPrefix)
    {
        $this->layoutPrefix = $layoutPrefix;

        return $this;
    }

    /**
     * Return the flash messenger.
     *
     * @return PluginFlashMessenger
     */
    public function getFlashMessenger()
    {
        return $this->flashMessenger;
    }

    /**
     * Sets the flash messenger.
     *
     * @param PluginFlashMessenger $flashMessenger
     *
     * @return $this
     */
    public function setFlashMessenger(PluginFlashMessenger $flashMessenger)
    {
        $this->flashMessenger = $flashMessenger;

        return $this;
    }

    /**
     * Return the PHP Renderer to render the partials.
     *
     * @return null|PhpRenderer
     */
    protected function getRenderer()
    {
        return $this->renderer;
    }

    /**
     *
     *
     * @param PhpRenderer $renderer
     *
     * @return $this
     */
    public function setRenderer(PhpRenderer $renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }

    /**
     * Render a namespace.
     *
     * @param string $namespace
     * @param bool   $includeCurrent
     * @param bool   $forceClear
     *
     * @return string
     * @throws \Zend\View\Exception\DomainException
     * @throws \Zend\View\Exception\InvalidArgumentException
     * @throws \Zend\View\Exception\RuntimeException
     */
    public function renderNamespace($namespace, $includeCurrent = false, $forceClear = true)
    {
        $flashMessenger = $this->getFlashMessenger();
        $result         = '';

        $messages = $flashMessenger->getMessagesFromNamespace($namespace);

        if ($includeCurrent) {
            $messages = array_merge(
                $messages,
                $flashMessenger->getCurrentMessagesFromNamespace($namespace)
            );
        }

        $messages = array_unique($messages);

        foreach ($messages as $message) {
            $result .= $this->renderMessage($message, $namespace);
        }

        if ($forceClear) {
            $flashMessenger->clearMessagesFromNamespace($namespace);

            if ($includeCurrent) {
                $flashMessenger->clearCurrentMessagesFromNamespace($namespace);
            }
        }

        return $result;
    }

    /**
     * Render a message.
     *
     * @param string $message
     * @param string $namespace
     *
     * @return string
     * @throws \Zend\View\Exception\DomainException
     * @throws \Zend\View\Exception\InvalidArgumentException
     * @throws \Zend\View\Exception\RuntimeException
     */
    public function renderMessage($message, $namespace = null)
    {
        /** @noinspection PhpUndefinedMethodInspection */
        $viewModel = new ViewModel(
            [
                'namespace' => $namespace,
                /** @noinspection PhpUndefinedMethodInspection */
                'message'   => $this->view->translate($message)
            ]
        );

        $viewModel->setTemplate($this->layoutPrefix . $namespace);

        return $this->getRenderer()->render($viewModel);
    }

    /**
     * Render all messages.
     *
     * @param bool $includeCurrent
     * @param bool $forceClear
     *
     * @return string
     * @throws \Zend\View\Exception\DomainException
     * @throws \Zend\View\Exception\InvalidArgumentException
     * @throws \Zend\View\Exception\RuntimeException
     */
    public function renderAllNamespaces($includeCurrent = false, $forceClear = true)
    {
        $namespaces = $this->namespaces;
        $result     = '';

        foreach ($namespaces as $namespace) {
            $result .= $this->renderNamespace($namespace, $includeCurrent, $forceClear);
        }

        return $result;
    }
} 
