<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Http\Converter;

use Goomento\Base\Http\ConverterInterface;
use Magento\Framework\Serialize\Serializer\Json;

/**
 * Class JsonToArray
 * @package Goomento\Base\Http\Converter
 */
class JsonToArray implements ConverterInterface
{

    /**
     * @var Json
     */
    private $serializer;

    /**
     * JsonToArray constructor.
     *
     * @param Json            $serializer
     */
    public function __construct(
        Json $serializer
    ) {
        $this->serializer = $serializer;
    }

    /**
     * Converts gateway response to array structure
     *
     * @param mixed $response
     * @return array
     */
    public function convert($response)
    {
        return $this->serializer->unserialize($response);
    }
}
