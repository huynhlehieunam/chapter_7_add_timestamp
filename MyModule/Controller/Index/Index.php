<?php
namespace Magenest\MyModule\Controller\Index;

use Magenest\MyModule\Api\MyInterface;
use Magenest\MyModule\Model\MyClass;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends Action
{
    protected $_pageFactory;
    /**
     * @var MyClass
     */
    private $myClass;
    /**
     * @var MyInterface
     */
    private $myInterface;

    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        MyInterface $myInterface
    ) {
        $this->_pageFactory = $pageFactory;
        $this->myInterface = $myInterface;
        return parent::__construct($context);
    }

    public function execute()
    {
        $this->myInterface->foo();
        return $this->_pageFactory->create();
    }
}
