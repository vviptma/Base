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

    /**
     * @param $name
     * @return null
     * @throws \ReflectionException
     */
    public function __get($name)
    {
        /**
         * This property might properly call outside the Native Class Scope, so omit that now
         * TODO: Need more effort to detect
         */
        list(, $caller) = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 2);
        $caller = $caller['class'] ?? null;
        if ($caller===get_class($this)) {
            foreach ($this->_objectsMapping() as $key => $class) {
                if ($key===$name) {
                    return is_string($class) ? self::instanceGet($class) : $class;
                }
            }
        }
    }

    /**
     * @return string[]
     */
    private function _objectsMapping()
    {
        return [
            'objectManager' => \Magento\Framework\App\ObjectManager::getInstance(),
            'directoryHelper' => \Magento\Directory\Helper\Data::class,
            'currencyFactory' => \Magento\Directory\Model\CurrencyFactory::class,
            'storeManager' => \Magento\Store\Model\StoreManagerInterface::class,
            'scopeConfig' => \Magento\Framework\App\Config\ScopeConfigInterface::class,
        ];
    }
}
