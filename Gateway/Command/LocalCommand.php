<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Gateway\Command;

/**
 * Class LocalCommand
 * @package Goomento\Base\Gateway\Command
 */
class LocalCommand extends AbstractCommand
{
    /**
     * @param array $commandSubject
     * @return \Magento\Payment\Gateway\Command\ResultInterface|void|null
     * @throws \Magento\Payment\Gateway\Command\CommandException
     */
    public function execute(array $commandSubject)
    {
        if ($this->validator !== null) {
            $result = $this->validator->validate($commandSubject);
            if (!$result->isValid()) {
                $this->processErrors($result);
            }
        }

        if ($this->handler) {
            $this->handler->handle($commandSubject, []);
        }
    }
}
