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

use Traversable;
use Xloit\Bridge\Zend\EventManager\Listener\AbstractListenerAggregate;
use Xloit\Bridge\Zend\EventManager\Listener\ListenerOptions;
use Xloit\Bridge\Zend\View\Model\CharsetViewModel;
use Xloit\Bridge\Zend\View\Model\ViewModel;
use Zend\EventManager\EventManagerInterface;
use Zend\Http\Header\ContentType;
use Zend\View\Model\ModelInterface;
use Zend\View\Renderer\RendererInterface;
use Zend\View\ViewEvent;

/**
 * An {@link AbstractStrategy} abstract class.
 *
 * @abstract
 * @package Xloit\Bridge\Zend\View\Strategy
 */
abstract class AbstractStrategy extends AbstractListenerAggregate
{
    /**
     *
     *
     * @var \Zend\View\Renderer\RendererInterface $renderer
     */
    protected $renderer;

    /**
     * Constructor to prevent {@link AbstractStrategy} from being loaded more than once.
     *
     * @param RendererInterface                 $renderer
     * @param ListenerOptions|array|Traversable $options
     */
    public function __construct(RendererInterface $renderer, $options = null)
    {
        $this->setRenderer($renderer);

        parent::__construct($options);
    }

    /**
     * Attach one or more listeners.
     *
     * @param \Zend\EventManager\EventManagerInterface $events
     * @param int                                      $priority
     *
     * @return void
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            ViewEvent::EVENT_RENDERER,
            [
                $this,
                'selectRenderer'
            ],
            $priority
        );

        $this->listeners[] = $events->attach(
            ViewEvent::EVENT_RESPONSE,
            [
                $this,
                'injectResponse'
            ],
            $priority
        );
    }

    /**
     *
     *
     * @param \Zend\View\Renderer\RendererInterface $renderer
     *
     * @return $this
     */
    public function setRenderer(RendererInterface $renderer)
    {
        $this->renderer = $renderer;

        return $this;
    }

    /**
     *
     *
     * @return RendererInterface
     */
    public function getRenderer()
    {
        return $this->renderer;
    }

    /**
     * Detect if we should use the specific renderer based on model type and/or Accept header.
     *
     * @param ViewEvent $e
     *
     * @return null|RendererInterface
     */
    public function selectRenderer(ViewEvent $e)
    {
        $model = $e->getModel();

        if (!$this->isValidModel($model)) {
            // No valid Model; nothing to do
            return null;
        }

        if (null === $this->getRenderer()) {
            $this->setRenderer($e->getRenderer());
        }

        return $this->getRenderer();
    }

    /**
     * Inject the response with the feed payload and appropriate Content-Type header.
     *
     * @param ViewEvent $e
     *
     * @return void
     */
    public function injectResponse(ViewEvent $e)
    {
        $renderer = $e->getRenderer();

        if ($renderer !== $this->getRenderer()) {
            return;
        }

        /** @var $response \Zend\Http\PhpEnvironment\Response */
        $response    = $e->getResponse();
        $result      = $e->getResult();
        $model       = $e->getModel();
        $headers     = $response->getHeaders();
        $contentType = new ContentType();

        $response->setContent($result);

        if ($model instanceof ViewModel) {
            $contentType->setMediaType($model->getContentType());
        }

        if ($model instanceof CharsetViewModel && null !== $model->getCharset()) {
            $contentType->setMediaType($model->getCharset());
        }

        if ($contentType->getFieldValue()) {
            $headers->addHeader($contentType);
        }
    }

    /**
     * Indicates whether the given model is valid.
     *
     * @param ModelInterface $model
     *
     * @return bool
     */
    abstract protected function isValidModel(ModelInterface $model);
} 
