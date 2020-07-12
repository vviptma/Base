<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Model;

use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\ObjectManager\TMap;
use Magento\Framework\ObjectManager\TMapFactory;

/**
 * Class BuilderComposite
 * @package Goomento\Base\Model
 */
class BuilderComposite implements BuilderInterface
{
    /**
     * @var BuilderInterface[] | TMap
     */
    protected $builders;

    /**
     * @param TMapFactory $tmapFactory
     * @param array $builders
     */
    public function __construct(
        TMapFactory $tmapFactory,
        array $builders = []
    ) {
        $this->builders = $tmapFactory->create(
            [
                'array' => $builders,
                'type' => BuilderInterface::class
            ]
        );
    }

    /**
     * Builds ENV request
     *
     * @param array $buildSubject
     * @return array
     */
    public function build(array $buildSubject)
    {
        $result = [];
        foreach ($this->builders as $builder) {
            // @TODO implement exceptions catching
            $result = $this->merge($result, $builder->build($buildSubject));
        }

        return $result;
    }

    /**
     * Merge function for builders
     *
     * @param array $result
     * @param array $builder
     * @return array
     */
    protected function merge(array $result, array $builder)
    {
        return array_replace_recursive($result, $builder);
    }

    /**
     * @param $commandCode
     * @return BuilderInterface|mixed
     * @throws NotFoundException
     */
    public function get($commandCode)
    {
        if (!isset($this->builders[$commandCode])) {
            throw new NotFoundException(
                __('The "%1" component doesn\'t exist. Verify the command and try again.', $commandCode)
            );
        }

        return $this->builders[$commandCode];
    }
}
