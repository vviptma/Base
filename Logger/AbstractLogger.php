<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Logger;

/**
 * Class AbstractLogger
 * @package Goomento\Base\Logger
 */
abstract class AbstractLogger extends \Magento\Framework\Logger\Monolog
{
    /**
     * AbstractLogger constructor.
     * @param $name
     * @param array $handlers
     * @param array $processors
     * @throws \Exception
     */
    public function __construct($name, array $handlers = [], array $processors = [])
    {
        if (!isset($handlers[$name])) {
            $handlers[] = new FileHandler(null, $name);
        }
        parent::__construct($name, $handlers, $processors);
    }

    /**
     * @param int $level
     * @param string $message
     * @param array $context
     * @return bool
     */
    public function addRecord($level, $message, array $context = [])
    {
        if (is_array($message)) {
            $message = json_encode($message);
        }
        return parent::addRecord($level, $message, $context);
    }
}
