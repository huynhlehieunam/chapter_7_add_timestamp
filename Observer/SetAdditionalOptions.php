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

use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Serialize\Serializer\Json;
use Magento\Framework\Stdlib\DateTime\DateTime;

class SetAdditionalOptions implements ObserverInterface
{
    /**
     * @var RequestInterface
     */
    protected $_request;
    /**
     * @var Json
     */
    private $serialize;
    /**
     * @var DateTime
     */
    private $date;

    /**
     * @param RequestInterface $request
     */
    public function __construct(
        RequestInterface $request,
        DateTime $date,
        Json $serialize
    ) {
        $this->_request = $request;
        $this->serialize = $serialize;
        $this->date = $date;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        if ($this->_request->getFullActionName() == 'checkout_cart_add') { //checking when product is adding to cart
            $product = $observer->getProduct();
            $additionalOptions = [];
            $additionalOptions[] = [
                'label' => "Timestamp",
                'value' => $this->date->timestamp()
            ];
            $observer->getProduct()->addCustomOption('additional_options', json_encode($additionalOptions));
        }
    }
}
