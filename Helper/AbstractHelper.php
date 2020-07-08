<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Helper;

use Goomento\Base\Exceptions\UndefinedMethodCall;
/**
 * Class AbstractHelper
 * @package Goomento\Base\Helper
 */
abstract class AbstractHelper extends \Magento\Framework\App\Helper\AbstractHelper
{
    use \Goomento\Base\Traits\CallStatically;
}
