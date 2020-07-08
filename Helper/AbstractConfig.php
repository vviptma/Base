<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Helper;

use Goomento\Base\Exceptions\UndefinedMethodCall;
use Magento\Framework\App\Helper\Context;

/**
 * Class Config
 * @package Goomento\Base\Helper
 * @method static staticConfigGet(string $path, $default = null, $storeId = null)
 * @method static staticConfigGetBool(string $path, $default = null, $storeId = null)
 * @method static staticConfigGetArray(string $path, $default = [], $storeId = null)
 * @method static staticConfigNarrowScope($section, $group = null)
 * @method static staticIsActive() : bool
 */
abstract class AbstractConfig extends AbstractHelper
{
    use \Goomento\Base\Traits\Config;

    /**
     * Config constructor.
     * @param Context $context
     * @param array $scope
     */
    public function __construct(Context $context, array $scope = [])
    {
        parent::__construct($context);
        $this->configNarrowScope($scope);
    }

    /**
     * @return bool
     */
    public function isActive() : bool
    {
        return $this->configGetBool('active');
    }

    public static function __callStatic($name, $arguments)
    {
        try {
            return parent::__callStatic($name, $arguments);
        } catch (UndefinedMethodCall $e) {
            $method = lcfirst(substr($name, 6));
            /** @var AbstractConfig $object */
            $object = self::instanceGet();
            return $object->configGet($method);
        }
    }
}
