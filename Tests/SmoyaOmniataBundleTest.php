<?php

namespace Smoya\Bundle\OmniataBundle\Tests;

use Smoya\Bundle\OmniataBundle\SmoyaOmniataBundle;

class SmoyaOmniataBundleTest extends \PHPUnit_Framework_TestCase
{
    public function testBundleWorks()
    {
        $bundle = new SmoyaOmniataBundle();
        $this->assertEquals('SmoyaOmniataBundle', $bundle->getName());
    }
}
