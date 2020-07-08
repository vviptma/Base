<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Http;

/**
 * Interface ConverterInterface
 * @package Goomento\Base\Http
 */
interface ConverterInterface
{
    /**
     * @param $response
     * @return mixed
     */
    public function convert($response);
}
