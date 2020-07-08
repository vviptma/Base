<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */
namespace Goomento\Base\Http;

/**
 * Interface TransferInterface
 * @package Goomento\Base\Http
 */
interface TransferInterface
{
    /**
     * Returns gateway client configuration
     *
     * @return array
     */
    public function getClientConfig();

    /**
     * Returns method used to place request
     *
     * @return string|int
     */
    public function getMethod();

    /**
     * Returns headers
     *
     * @return array
     */
    public function getHeaders();

    /**
     * Whether body should be encoded before place
     *
     * @return bool
     */
    public function shouldEncode();

    /**
     * Returns request body
     *
     * @return array|string
     */
    public function getBody();

    /**
     * Returns URI
     *
     * @return string
     */
    public function getUri();

    /**
     * Returns Auth username
     *
     * @return string
     */
    public function getAuthUsername();

    /**
     * Returns Auth password
     *
     * @return string
     */
    public function getAuthPassword();
}
