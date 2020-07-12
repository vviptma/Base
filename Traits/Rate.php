<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Traits;


use Magento\Framework\Exception\LocalizedException;

/**
 * Trait Rate
 * @package Goomento\Base\Traits
 * @property \Magento\Directory\Helper\Data $directoryHelper
 * @property \Magento\Directory\Model\CurrencyFactory $currencyFactory
 * @property \Magento\Store\Model\StoreManagerInterface $storeManager
 */
trait Rate
{
    /**
     * @param $amount
     * @param $from
     * @param null $to
     * @return false|float
     * @throws LocalizedException
     */
    public function convertCurrency($amount, $from, $to = null)
    {
        try {
            if ($from !== $to) {
                if ($to === $this->getBaseCurrencyCode()) {
                    return round($this->convertToBaseCurrency($amount, $from));
                }

                $amount = $this->directoryHelper->currencyConvert($amount, $from, $to);
            }
            return round($amount);
        } catch (\Exception $e) {
            throw new LocalizedException(__("Please, setup your currency ..."));
        }
    }

    /**
     * @param $amount
     * @param $from
     * @return float|int
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    protected function convertToBaseCurrency($amount, $from)
    {
        $rate = $this->currencyFactory->create()->load($this->getBaseCurrencySymbol())->getAnyRate($from);
        return $amount*$rate;
    }

    /**
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBaseCurrencySymbol()
    {
        return $this->storeManager->getStore()->getBaseCurrency()->getCode();
    }

    /**
     * Get store base currency code
     *
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getBaseCurrencyCode()
    {
        return $this->storeManager->getStore()->getBaseCurrencyCode();
    }
}
