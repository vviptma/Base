<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */
namespace Goomento\Base\Helper;

use Goomento\Base\Exceptions\UndefinedMethodCall;
use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Class Config
 * @package Goomento\Base\Helper
 * @method static staticConfigGet(string $path, $default = null)
 * @method static staticConfigGetBool(string $path, $default = null)
 * @method static staticConfigGetArray(string $path, $default = [])
 * @method static staticConfigNarrowScope($section, $group = null)
 * @method static staticIsActive() : bool
 */
abstract class AbstractPaymentGatewayConfig extends \Magento\Payment\Gateway\Config\Config
{
    use \Goomento\Base\Traits\Config;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * PaymentGatewayConfig constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param string|null $methodCode
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        $methodCode = null
    ) {
        parent::__construct($scopeConfig, $methodCode, self::DEFAULT_PATH_PATTERN);
        $this->scopeConfig = $scopeConfig;
        $this->configNarrowScope('payment', $methodCode);
    }

    /**
     * @return bool
     */
    public function active() : bool
    {
        return $this->configGetBool('active');
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws UndefinedMethodCall
     */
    public static function __callStatic($name, $arguments)
    {
        if (substr($name, 0, 6) === 'static') {
            $method = lcfirst(substr($name, 6));
            /** @var AbstractPaymentGatewayConfig $object */
            $object = self::instanceGet();
            if (method_exists($object, $method)) {
                return $object->$method(...$arguments);
            }
            throw new UndefinedMethodCall();
        }
    }
}
