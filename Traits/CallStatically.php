<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Traits;


use Goomento\Base\Exceptions\UndefinedMethodCallException;

/**
 * Trait CallStatically
 * @package Goomento\Base\Traits
 */
trait CallStatically
{
    /**
     * Use `static` as prefix to avoid any PHP standard loader
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws UndefinedMethodCallException
     * @throws \Exception
     */
    public static function __callStatic($name, $arguments)
    {
        if (substr($name, 0, 6) === 'static') {
            $method = lcfirst(substr($name, 6));
            $object = self::instanceGet();
            try {
                return $object->$method(...$arguments);
            } catch (\BadMethodCallException $e) {
                throw new UndefinedMethodCallException("Call undefined method {$method}");
            } catch (\Exception $e) {
                throw $e;
            }
        }
    }
}
