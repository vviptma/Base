<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Traits;

/**
 * Trait Datetime
 * @package Goomento\Base\Traits
 */
trait Datetime
{
    /**
     * @param $datetime
     * @param string $format
     * @return string
     * @throws \Exception
     */
    public static function formatDateTime($datetime, $format = 'm/d/y H:i:s')
    {
        $timeZone = self::instanceGet(\Magento\Framework\Stdlib\DateTime\TimezoneInterface::class);
        return $timeZone->date(new \DateTime($datetime))->format($format);
    }
}
