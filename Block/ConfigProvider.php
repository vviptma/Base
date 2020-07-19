<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Block;

use Goomento\Base\Model\ConfigBuilderProvider;
use Magento\Framework\View\Element\Template;

/**
 * Class CompositeConfigProvider
 * @package Goomento\Base\Block
 */
class ConfigProvider extends Template
{
    /**
     * @var ConfigBuilderProvider
     */
    protected $builder;

    /**
     * ConfigBuilderProvider constructor.
     * @param Template\Context $context
     * @param ConfigBuilderProvider $builder
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ConfigBuilderProvider $builder,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->builder = $builder;
    }

    /**
     * @return array|\string[][]
     */
    protected function introduction() : array
    {
        return [
            'base' => [
                'name' => 'Goomento'
            ]
        ];
    }

    /**
     * @return string
     */
    public function getSerializedConfig()
    {
        return \Zend_Json::encode($this->builder->build($this->introduction()));
    }
}
