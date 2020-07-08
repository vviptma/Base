<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Traits;

/**
 * Trait InstanceManager
 * @package Goomento\Base\Traits
 */
trait InstanceManager
{
    /**
     * @param $name
     * @return mixed
     */
    public static function instanceGet($name = null)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return $objectManager->get($name ?: static::class);
    }

    /**
     * @param $name
     * @param array $args
     * @return mixed
     */
    public static function instanceCreate($name = null, $args = [])
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        return $objectManager->create($name ?: static::class, $args);
    }

}
