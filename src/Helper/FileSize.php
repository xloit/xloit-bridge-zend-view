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

use Xloit\Bridge\Zend\View\Exception;

/**
 * A {@link FileSize} class.
 *
 * @package Xloit\Bridge\Zend\View\Helper
 */
class FileSize extends AbstractHelper
{
    /**
     *
     *
     * @var string
     */
    const AUTO = 'AUTO';

    /**
     *
     *
     * @var string
     */
    const B = 'B';

    /**
     *
     *
     * @var string
     */
    const GB = 'GB';

    /**
     *
     *
     * @var string
     */
    const KB = 'KB';

    /**
     *
     *
     * @var string
     */
    const MB = 'MB';

    /**
     *
     *
     * @var array
     */
    protected $sizes = [
        self::GB => 30,
        self::MB => 20,
        self::KB => 10,
        self::B  => 1
    ];

    /**
     * Get a file size label.
     *
     * @param int|float $size size in bytes
     * @param string    $outputUnit
     *
     * @return string
     * @throws Exception\RuntimeException
     */
    public function __invoke($size, $outputUnit = self::AUTO)
    {
        if (!defined(sprintf('%s::%s', static::class, $outputUnit))) {
            throw new Exception\RuntimeException("Wrong parameter type {$outputUnit}.");
        }

        if (self::AUTO === $outputUnit) {
            $outputUnit = $this->outputSize($size);
        }

        $size /= (1 << $this->sizes[$outputUnit]);

        // if the number is float, we keep only 2 digits after the decimal point
        /** @noinspection TypeUnsafeComparisonInspection */
        if ($size != (int) $size) {
            $size = number_format((float) $size, 2);
        }

        /**
         * in the previous if we may have gone in it with 2.0000001 and after it ended with $size = 2.00
         * so we should trim the 00
         */
        /** @noinspection TypeUnsafeComparisonInspection */
        if ($size == (int) $size) {
            $size = (int) $size;
        }

        return sprintf('%s %s', (string) $size, $outputUnit);
    }

    /**
     * Calculate the best output size (KB, MB...).
     *
     * @param int|float $size size in bytes
     *
     * @return string
     */
    private function outputSize($size)
    {
        $result = null;

        foreach ($this->sizes as $type => $mul) {
            $result = $type;

            if ($size >= (1 << $mul)) {
                break;
            }
        }

        // return the smallest (last one iterated) size type
        return $result;
    }
}
