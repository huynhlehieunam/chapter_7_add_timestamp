<?php
/**
 * Webkul Software.
 *
 * @category  Webkul
 * @package   Webkul_Demo
 * @author    Webkul
 * @copyright Copyright (c) 2010-2016 Webkul Software Private Limited (https://webkul.com)
 * @license   https://store.webkul.com/license.html
 */
namespace Magenest\AddTimestamp\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\RequestInterface;

class SetAdditionalOptions implements ObserverInterface
{
    /**
     * @var RequestInterface
     */
    protected $_request;
    /**
     * @var \Magento\Framework\Serialize\Serializer\Json
     */
    private $serialize;

    /**
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request,
        \Magento\Framework\Serialize\Serializer\Json $serialize
    ) {
        $this->_request = $request;
        $this->serialize = $serialize;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
// Check and set information according to your need
        if ($this->_request->getFullActionName() == 'checkout_cart_add') { //checking when product is adding to cart
            $product = $observer->getProduct();
            $additionalOptions = [];
            $additionalOptions[] = array(
                'label' => "Some Label",
                'value' => "Your Information",
            );
            $observer->getProduct()->addCustomOption('additional_options', json_encode($additionalOptions));
        }
    }
}
