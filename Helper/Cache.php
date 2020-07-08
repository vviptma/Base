<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Helper;

use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\Helper\Context;

/**
 * Class Cache
 * @package Goomento\Base\Helper
 * @method Cache staticGetFrontend();
 * @method Cache staticLoad($identifier);
 * @method Cache staticSave($data, $identifier, $tags = [], $lifeTime = null);
 * @method Cache staticRemove($identifier);
 * @method Cache staticClean($tags = []);
 */
class Cache extends AbstractHelper implements CacheInterface
{
    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * Cache constructor.
     * @param Context $context
     * @param CacheInterface $cache
     */
    public function __construct(
        Context $context,
        CacheInterface $cache
    ) {
        parent::__construct($context);
        $this->cache = $cache;
    }

    /**
     * @return \Magento\Framework\Cache\FrontendInterface
     */
    public function getFrontend()
    {
        return $this->cache->getFrontend();
    }

    /**
     * @param string $identifier
     * @return string
     */
    public function load($identifier)
    {
        return $this->cache->load($identifier);
    }

    /**
     * @param string $data
     * @param string $identifier
     * @param array $tags
     * @param null $lifeTime
     * @return bool
     */
    public function save($data, $identifier, $tags = [], $lifeTime = null)
    {
        return $this->cache->save($data, $identifier, $tags = [], $lifeTime = null);
    }

    /**
     * @param string $identifier
     * @return bool
     */
    public function remove($identifier)
    {
        return $this->cache->remove($identifier);
    }

    /**
     * @param array $tags
     * @return bool
     */
    public function clean($tags = [])
    {
        return $this->cache->clean($tags);
    }
}
