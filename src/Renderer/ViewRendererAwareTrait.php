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

namespace Xloit\Bridge\Zend\View\Renderer;

use Zend\View\Renderer\RendererInterface;

/**
 * A {@link ViewRendererAwareTrait} trait.
 *
 * @package Xloit\Bridge\Zend\View\Renderer
 */
trait ViewRendererAwareTrait
{
    /**
     *
     *
     * @var RendererInterface
     */
    protected $view;

    /**
     * Get the view object.
     *
     * @return RendererInterface
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * Set the View object.
     *
     * @param RendererInterface $view
     *
     * @return $this
     */
    public function setView(RendererInterface $view)
    {
        $this->view = $view;

        return $this;
    }
}
