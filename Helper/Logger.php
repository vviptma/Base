<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Helper;

use Magento\Framework\App\Helper\Context;
use Psr\Log\LoggerInterface;

/**
 * Class Logger
 * @package Goomento\Base\Helper
 * @method static staticCritical($message, $extra = [])
 * @method static staticEmergency($message, $extra = [])
 * @method static staticAlert($message, $extra = [])
 * @method static staticWarning($message, $extra = [])
 * @method static staticError($message, $extra = [])
 * @method static staticNotice($message, $extra = [])
 * @method static staticInfo($message, $extra = [])
 * @method static staticDebug($message, $extra = [])
 * @method static staticLog($level, $message, $extra = [])
 */
class Logger extends AbstractHelper
{
    use \Goomento\Base\Traits\Logger;

    /**
     * Logger constructor.
     * @param Context $context
     * @param LoggerInterface|null $logger
     * @param string|null $log_name
     */
    public function __construct(
        Context $context,
        LoggerInterface $logger = null,
        string $log_name = null
    ) {
        parent::__construct($context);
        $this->log_name = $log_name;
        $this->logger = $logger;
    }
}
