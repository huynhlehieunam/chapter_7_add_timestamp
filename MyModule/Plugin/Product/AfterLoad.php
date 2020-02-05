<?php
namespace Magenest\MyModule\Plugin\Product;

use Magento\Catalog\Model\Product;
use Magento\Framework\Stdlib\DateTime\DateTime;

class AfterLoad{
    /**
     * @var DateTime
     */
    private $dateTime;
    /**
     * @var \DateTime
     */
    private $dateTimePhp;

    public function __construct(DateTime $dateTime, \DateTime $dateTimePhp)
    {
        $this->dateTime = $dateTime;
        $this->dateTimePhp = $dateTimePhp;
    }

    public function afterAfterLoad(Product $subject,Product $result){
        $now = $this->dateTime->gmtTimestamp();
        $date = (new \DateTime($result->getData('special_to_date')))->getTimestamp();

        if ( $date>$now){
            $result->setData('name',$result->getData('name').' special');
        }
        return $result;
    }
}
