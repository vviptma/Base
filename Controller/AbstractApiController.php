<?php
/**
 * @author @haihv433
 * @copyright Copyright (c) 2020 Goomento (https://store.goomento.com)
 * @package Goomento_Base
 * @link https://github.com/Goomento/Base
 */

namespace Goomento\Base\Controller;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Request\InvalidRequestException;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Phrase;

/**
 * Class AbstractApiController
 * @package Goomento\Base\Controller
 */
abstract class AbstractApiController extends AbstractController implements \Magento\Framework\App\CsrfAwareActionInterface
{

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonResultFactory;

    public function __construct(Context $context)
    {
        parent::__construct($context);
        $this->jsonResultFactory = self::instanceGet(\Magento\Framework\Controller\Result\JsonFactory::class);
    }

    /**
     * @inheritDoc
     */
    public function validateForCsrf(RequestInterface $request): ?bool
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    public function createCsrfValidationException(RequestInterface $request): ?InvalidRequestException
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('*/*/');

        return new InvalidRequestException(
            $resultRedirect,
            [new Phrase('Invalid Form Key. Please refresh the page.')]
        );
    }

    /**
     * @param array $data
     * @param int $code
     * @return Json
     * @see \Magento\Framework\Webapi\Response
     * @see \Magento\Framework\Webapi\Response
     */
    public function response($data = [], $code = \Magento\Framework\App\Response\Http::STATUS_CODE_200)
    {
        $result = $this->jsonResultFactory->create();
        $result->setData($data);
        $result->setHttpResponseCode($code);
        $result->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0', true);
        return $result;
    }

    /**
     * @param array $data
     * @return Json
     */
    public function responseError($data = [])
    {
        return $this->response($this->parseData($data), \Magento\Framework\App\Response\Http::STATUS_CODE_403);
    }

    /**
     * @param $data
     * @return Json
     */
    public function responseOk($data)
    {
        return $this->response($this->parseData($data));
    }

    /**
     * @param array $data
     * @return array|string|string[]
     */
    protected function parseData($data = [])
    {
        /** To void string translator */
        if ($data == @(string)$data) {
            $data = ['message' => $data];
        }
        return $data;
    }
}
