<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Model;


use Magento\Framework\ObjectManager\TMapFactory;

/**
 * Class ConfigBuilderProvider
 * @package Goomento\Base\Model
 */
class ConfigBuilderProvider extends BuilderComposite
{
    /**
     * ConfigBuilderProvider constructor.
     * @param TMapFactory $tmapFactory
     * @param array $configProviders
     */
    public function __construct(TMapFactory $tmapFactory, array $configProviders = [])
    {
        parent::__construct($tmapFactory, $configProviders);
    }
}
