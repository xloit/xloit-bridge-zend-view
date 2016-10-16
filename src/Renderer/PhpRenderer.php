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

use Xloit\Bridge\Zend\Authentication\AuthenticationService;
use Xloit\Bridge\Zend\Form\View\Helper as FormHelper;
use Xloit\Bridge\Zend\Mvc\Controller\Plugin\Placeholder\HtmlClassContainer;
use Xloit\Bridge\Zend\View\Helper;
use Zend\Form\ElementInterface;
use Zend\Form\FormInterface;
use Zend\Form\View\Helper as ZendFormHelper;
use Zend\I18n\View\Helper as I18nHelper;
use Zend\View\Renderer\PhpRenderer as ZendPhpRenderer;

/**
 * A {@link PhpRenderer} class
 *
 * @package Xloit\Bridge\Zend\View\Renderer
 *
 * @method ZendFormHelper\Form|string form(FormInterface $form = null)
 * @method ZendFormHelper\FormButton|string formButton(ElementInterface $element = null, $buttonContent = null)
 * @method ZendFormHelper\FormCaptcha|string formCaptcha(ElementInterface $element = null)
 * @method ZendFormHelper\FormCheckbox|string formCheckbox(ElementInterface $element = null)
 * @method ZendFormHelper\FormCollection|string formCollection(ElementInterface $element = null, $wrap = true)
 * @method ZendFormHelper\FormColor|string formColor(ElementInterface $element = null)
 * @method ZendFormHelper\FormDate|string formDate(ElementInterface $element = null)
 * @method ZendFormHelper\FormDateSelect|string formDateSelect(ElementInterface $element = null)
 * @method ZendFormHelper\FormDateTime|string formDateTime(ElementInterface $element = null)
 * @method ZendFormHelper\FormDateTimeLocal|string formDateTimeLocal(ElementInterface $element = null)
 * @method ZendFormHelper\FormDateTimeSelect|string formDateTimeSelect(ElementInterface $element = null, $dateType = 1)
 * @method ZendFormHelper\FormElement|string formElement(ElementInterface $element = null)
 * @method ZendFormHelper\FormElementErrors|string formElementErrors(ElementInterface $element = null)
 * @method ZendFormHelper\FormEmail|string formEmail(ElementInterface $element = null)
 * @method ZendFormHelper\FormFile|string formFile(ElementInterface $element = null)
 * @method ZendFormHelper\FormHidden|string formHidden(ElementInterface $element = null)
 * @method ZendFormHelper\FormImage|string formImage(ElementInterface $element = null)
 * @method ZendFormHelper\FormInput|string formInput(ElementInterface $element = null)
 * @method ZendFormHelper\FormLabel|string formLabel(ElementInterface $element = null, $label = null, $position = null)
 * @method ZendFormHelper\FormMonth|string formMonth(ElementInterface $element = null)
 * @method ZendFormHelper\FormMonthSelect|string formMonthSelect(ElementInterface $element = null, $dateType = 1)
 * @method ZendFormHelper\FormMultiCheckbox|string formMultiCheckbox(ElementInterface $element = null)
 * @method ZendFormHelper\FormNumber|string formNumber(ElementInterface $element = null)
 * @method ZendFormHelper\FormRadio|string formRadio(ElementInterface $element = null, $labelPosition = null)
 * @method ZendFormHelper\FormRange|string formRange(ElementInterface $element = null)
 * @method ZendFormHelper\FormReset|string formReset(ElementInterface $element = null)
 * @method ZendFormHelper\FormRow|string formRow(ElementInterface $element = null, $labelPosition = null)
 * @method ZendFormHelper\FormSearch|string formSearch(ElementInterface $element = null)
 * @method ZendFormHelper\FormSelect|string formSelect(ElementInterface $element = null)
 * @method ZendFormHelper\FormTel|string formTel(ElementInterface $element = null)
 * @method ZendFormHelper\FormText|string formText(ElementInterface $element = null)
 * @method ZendFormHelper\FormTextarea|string formTextarea(ElementInterface $element = null)
 * @method ZendFormHelper\FormTime|string formTime(ElementInterface $element = null)
 * @method ZendFormHelper\FormUrl|string formUrl(ElementInterface $element = null)
 * @method ZendFormHelper\FormWeek|string formWeek(ElementInterface $element = null)
 *
 * @method I18nHelper\Translate|string translate($message, $textDomain = null, $locale = null)
 * @method Helper\Authentication|AuthenticationService authentication()
 * @method Helper\Configuration|mixed config($path = null, $default = null)
 * @method Helper\Date date($date, $timezone = null, $format = null)
 * @method Helper\FileSize fileSize($size, $outputUnit = Helper\FileSize::AUTO)
 * @method Helper\FlashMessenger|string flashMessenger($namespace = null, $includeCurrent = false, $forceClear = true)
 * @method Helper\Gravatar gravatar($email = null, $options = [], $attributes = [])
 * @method Helper\HasGravatar hasGravatar($email = null)
 * @method Helper\HtmlClass|HtmlClassContainer htmlClass($key = null, $value = null, $setType = null)
 * @method Helper\Title title($value = null, $setType = null)
 * @method string url($name = null, array $params = [], array $options = [], $reuseMatchedParams = false)
 *
 * @method string formButtonIcon(ElementInterface $element, $buttonContent = null)
 * @method string formCkEditor(ElementInterface $element = null, $options = [])
 * @method FormHelper\FormPassword|string formPassword(ElementInterface $element = null)
 * @method FormHelper\FormSubmit|string formSubmit(ElementInterface $element = null)
 */
class PhpRenderer extends ZendPhpRenderer
{
} 
