<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Logger;

use Magento\Framework\Filesystem\DriverInterface;

/**
 * @package Goomento\Base\Logger
 */
class FileHandler extends \Magento\Framework\Logger\Handler\Base
{
    public function __construct(DriverInterface $filesystem = null, $fileName = null)
    {
        /**
         * Default file system
         */
        if (is_null($fileName)) {
            $fileName = '_debug.log';
        }

        /**
         * Add suffix to the end
         */
        if (substr($fileName, -4, 0) !== '.log') {
            $fileName .= '.log';
        }

        if (is_null($filesystem)) {
            $filesystem = new \Magento\Framework\Filesystem\Driver\File();
        }

        $filePath = BP . '/var/goomento/';

        parent::__construct($filesystem, $filePath, $fileName);
    }
}
