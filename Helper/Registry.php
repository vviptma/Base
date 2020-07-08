<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Helper;

use Magento\Framework\App\Helper\Context;
use Magento\Framework\Registry as CoreRegistry;

/**
 * Class Registry
 * @package Goomento\Base\Helper
 * @method static staticRegister($key, $value, $graceful = false);
 * @method static staticUnregister($key);
 * @method static staticRegistry($key);
 */
class Registry extends AbstractHelper
{
    /**
     * @var CoreRegistry
     */
    protected $registry;

    public function __construct(
        Context $context,
        CoreRegistry $registry
    ) {
        parent::__construct($context);
        $this->registry = $registry;
    }

    /**
     * @param $key
     * @return mixed|null
     */
    public function registry($key)
    {
        return $this->registry->registry($key);
    }

    /**
     * @param $key
     * @param $value
     * @param bool $graceful
     */
    public function register($key, $value, $graceful = false)
    {
        $this->registry->register($key, $value, $graceful);
    }

    /**
     * @param $key
     */
    public function unregister($key)
    {
        $this->registry->unregister($key);
    }
}
