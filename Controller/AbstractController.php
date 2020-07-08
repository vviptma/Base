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
 * Class AbstractController
 * @package Goomento\Base\Controller
 */
abstract class AbstractController extends \Magento\Framework\App\Action\Action
{
    use \Goomento\Base\Traits\InstanceManager;

    /**
     * @return bool
     */
    public function isPost()
    {
        return $this->getRequest()->isPost();
    }

    /**
     * @return bool
     */
    public function isGet()
    {
        return $this->getRequest()->isGet();
    }

    /**
     * @param string $slug
     * @return string|null
     */
    public static function getSlug(string $slug = '')
    {
        $class = static::class;
        $routes = substr($class, strpos($class, '\\Controller\\') + 12);

        if ($routes) {
            if (strpos($routes, 'Adminhtml', 0) !== false) {
                $routes = substr($routes, 10);
            }
            $routes = explode('\\', $routes);
            foreach ($routes as &$r) {
                $r = lcfirst($r);
            }

            return ($slug ?: rtrim($slug, '\\/')) . '/' . implode('/', $routes);
        }

        return null;
    }
}
