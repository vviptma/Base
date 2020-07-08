<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (http://goomento.com)
 * @package Goomento_Base
 */
namespace Goomento\Base\Http\Client;

use Goomento\Base\Http\ClientInterface;
use Goomento\Base\Http\ConverterInterface;
use Goomento\Base\Http\TransferInterface;
use Magento\Framework\HTTP\ZendClient;
use Magento\Framework\HTTP\ZendClientFactory;
use Psr\Log\LoggerInterface;

/**
 * Class Zend
 * @see \Magento\Payment\Gateway\Http\Client
 */
class Zend implements ClientInterface
{
    /**
     * @var ZendClientFactory
     */
    protected $clientFactory;

    /**
     * @var ConverterInterface | null
     */
    protected $converter;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @param ZendClientFactory $clientFactory
     * @param LoggerInterface $logger
     * @param ConverterInterface | null $converter
     */
    public function __construct(
        ZendClientFactory $clientFactory,
        LoggerInterface $logger,
        ConverterInterface $converter = null
    ) {
        $this->clientFactory = $clientFactory;
        $this->converter = $converter;
        $this->logger = $logger;
    }

    /**
     * @param TransferInterface $transferObject
     * @return array
     * @throws \Goomento\Base\Http\ClientException
     * @throws \Zend_Http_Client_Exception
     * @throws \Exception
     */
    public function placeRequest(TransferInterface $transferObject)
    {
        $log = [
            'request' => $transferObject->getBody(),
            'request_uri' => $transferObject->getUri()
        ];
        $result = [];
        /** @var ZendClient $client */
        $client = $this->clientFactory->create();

        $client->setConfig($transferObject->getClientConfig());
        $client->setMethod($transferObject->getMethod());

        switch ($transferObject->getMethod()) {
            case \Zend_Http_Client::GET:
                $client->setParameterGet($transferObject->getBody());
                break;
            case \Zend_Http_Client::POST:
                $client->setRawData($transferObject->getBody());
                break;
            default:
                throw new \LogicException(
                    sprintf(
                        'Unsupported HTTP method %s',
                        $transferObject->getMethod()
                    )
                );
        }

        $client->setHeaders($transferObject->getHeaders());
        $client->setUrlEncodeBody($transferObject->shouldEncode());
        $client->setUri($transferObject->getUri());

        try {
            $response = $client->request();

            $result = $this->converter
                ? $this->converter->convert($response->getBody())
                : [$response->getBody()];
            $log['response'] = $result;
        } catch (\Zend_Http_Client_Exception $e) {
            throw new \Goomento\Base\Http\ClientException(
                __($e->getMessage())
            );
        } catch (\Exception $e) {
            throw $e;
        } finally {
            $this->logger->debug(json_encode($log));
        }

        return $result;
    }
}
