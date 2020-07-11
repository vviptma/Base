<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */
namespace Goomento\Base\Traits;

use Psr\Log\LoggerInterface;

/**
 * Trait Logger
 * @package Goomento\Base\Traits
 * @property \Goomento\Base\Logger\Logger $logger
 * @property string $log_name
 * @method LoggerInterface critical($message, $extra = [])
 * @method LoggerInterface emergency($message, $extra = [])
 * @method LoggerInterface alert($message, $extra = [])
 * @method LoggerInterface warning($message, $extra = [])
 * @method LoggerInterface error($message, $extra = [])
 * @method LoggerInterface notice($message, $extra = [])
 * @method LoggerInterface info($message, $extra = [])
 * @method LoggerInterface debug($message, $extra = [])
 * @method LoggerInterface log($level, $message, $extra = [])
 */
trait Logger
{
    /**
     * @param $name
     * @param $arguments
     * @return mixed
     */
    public function __call($name, $arguments)
    {
        $this->logGetLogger();
        if (method_exists($this->logger, $name)) {
            return $this->logger->{$name}(...$arguments);
        }

        throw new \BadMethodCallException();
    }

    /**
     * @return bool|\Goomento\Base\Logger\Logger|mixed
     */
    protected function logGetLogger()
    {
        if (is_null($this->logger)) {
            /** @var \Goomento\Base\Logger\AbstractLogger logger */
            $this->logger = self::instanceCreate(
                \Goomento\Base\Logger\Logger::class,
                [$this->log_name ?? '']
            );
            if (!$this->logger) {
                // Set false to void any lazy load issues
                $this->logger = false;
            }
        }

        return $this->logger;
    }
}
