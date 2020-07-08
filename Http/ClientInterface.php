<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (http://goomento.com)
 * @package Goomento_Base
 */

namespace Goomento\Base\Http;

/**
 * Interface ClientInterface
 * @package Goomento\Base\Http
 */
interface ClientInterface
{
    /**
     * Places request to gateway. Returns result as ENV array
     *
     * @param \Goomento\Base\Http\TransferInterface $transferObject
     * @return array
     */
    public function placeRequest(\Goomento\Base\Http\TransferInterface $transferObject);
}
