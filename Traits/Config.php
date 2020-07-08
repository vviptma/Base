<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */
namespace Goomento\Base\Traits;

use Magento\Framework\App\Config\ScopeConfigInterface;

/**
 * Trait Config
 * @package Goomento\Base\Traits
 * @property $config_path = []
 */
trait Config
{
    use InstanceManager;

    /**
     * @param string $path
     * @param $default
     * @param null $storeId
     * @return mixed
     */
    public function configGet(string $path, $default = null, $storeId = null)
    {
        $this->_configScopeConfig();

        $real_config_path =  ($this->config_path ?? []) + array_fill(0, 3, '');

        $real_config_path = array_reverse($real_config_path);

        if ($_scopes = explode('/', $path)) {
            $_scopes = array_reverse($_scopes);
            $real_config_path = $_scopes + $real_config_path;
        }

        $real_config_path = implode('/', array_reverse($real_config_path));
        return $this->scopeConfig->getValue(
            $real_config_path,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $storeId
        ) ?? $default;
    }

    /**
     * @return ScopeConfigInterface
     */
    protected function _configScopeConfig()
    {
        if (!isset($this->scopeConfig) || is_null($this->scopeConfig)) {
            $this->scopeConfig = $this->instanceGet(ScopeConfigInterface::class);
        }

        return $this->scopeConfig;
    }

    /**
     * @param string $path
     * @param null $default
     * @param null $storeId
     * @return bool
     */
    public function configGetBool(string $path, $default = null, $storeId = null)
    {
        return (bool) $this->configGet($path, $default, $storeId);
    }

    /**
     * @param string $path
     * @param array $default
     * @param null $storeId
     * @return array
     */
    public function configGetArray(string $path, $default = [], $storeId = null)
    {
        return (array) explode(',', $this->configGet($path, '', $storeId)) ?: $default;
    }

    /**
     * @param $section
     * @param null $group
     * @return Config
     */
    public function configNarrowScope($section, $group = null)
    {
        $this->config_path = $this->config_path ?? [];

        if (is_array($section)) {
            $section = array_values($section);
            $this->config_path = $section + $this->config_path;
        } elseif (is_string($section)) {
            $_path = explode('/', $section) + array_reverse($this->config_path);
            $this->config_path = array_reverse($_path);
        }

        if (is_string($group)) {
            $this->config_path[1] = $group;
        }

        return $this;
    }
}
