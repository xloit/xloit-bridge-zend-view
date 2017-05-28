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

namespace Xloit\Bridge\Zend\View\Model;

use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\View\Model\FeedModel as ZendFeedModel;

/**
 * A {@link FeedModel} class.
 *
 * @package Xloit\Bridge\Zend\View\Model
 */
class FeedModel extends ZendFeedModel implements EventManagerAwareInterface
{
    use EventManagerAwareTrait;

    /**
     * Constructor to prevent {@link FeedModel} from being loaded more than once.
     *
     * @param null|array|\Traversable $variables
     * @param array|\Traversable      $options
     */
    public function __construct($variables = null, $options = null)
    {
        parent::__construct($variables, $options);

        if (!isset($this->context)) {
            $this->setVariable('context', $this);
        }
    }
} 
