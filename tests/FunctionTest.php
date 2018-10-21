<?php

namespace kofoworola\Subdomains\Tests;

use kofoworola\Subdomains\Facade\Subdomains;

class FunctionTest extends TestCase
{
    public function testParameter(){
        $parameter = Subdomains::parameter();
        $this->assertEquals('app',$parameter);
    }
}