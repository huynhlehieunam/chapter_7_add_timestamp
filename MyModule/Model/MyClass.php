<?php
namespace Magenest\MyModule\Model;

use Magenest\MyModule\Api\MyInterface;

class MyClass implements MyInterface
{
    public function foo()
    {
        echo "foo";
    }
}
