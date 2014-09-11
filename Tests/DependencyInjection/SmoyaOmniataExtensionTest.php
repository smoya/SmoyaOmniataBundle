<?php

namespace Smoya\Bundle\OmniataBundle\Tests\DependencyInjection;

use Smoya\Bundle\OmniataBundle\DependencyInjection\SmoyaOmniataExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class SmoyaOmniataExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var SmoyaOmniataExtension
     */
    private $extension;

    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    private $container;

    protected function setUp()
    {
        $this->extension = new SmoyaOmniataExtension();
        $this->container = new ContainerBuilder();
    }

    protected function tearDown()
    {
        unset($this->extension);
        unset($this->container);
    }

    public function testEmptyConfigUsesDefaultParameterValuesWhenCreated()
    {
        $apiKey = rand();
        $this->extension->load(array(array('api_key' => $apiKey)), $this->container);

        $this->assertTrue($this->container->has('smoya_omniata.client'));
        $this->assertTrue($this->container->has('smoya_omniata.deliverer'));
        $this->assertTrue($this->container->has('smoya_omniata.tracker'));

        $bundleOptions = $this->container->getParameterBag('smoya_omniata')->all();
        $this->assertEquals($apiKey, $bundleOptions['smoya_omniata.api_key']);
        $this->assertNull($bundleOptions['smoya_omniata.tracker.timeout']);
        $this->assertInternalType('string', $bundleOptions['smoya_omniata.tracker.url']);
        $this->assertNull($bundleOptions['smoya_omniata.deliverer.timeout']);
        $this->assertInternalType('string', $bundleOptions['smoya_omniata.deliverer.url']);
    }

    public function testExplicitConfigNotUsesDefaultParameterValuesWhenCreated()
    {
        $parameters = array(
            'api_key' => rand(),
            'tracker' => array(
                'url' => 'http://foo.com',
                'timeout' => 1000
            ),
            'deliverer' => array(
                'url' => 'http://bar.com',
                'timeout' => 1000
            )
        );

        $this->extension->load(array($parameters), $this->container);

        $this->assertTrue($this->container->has('smoya_omniata.client'));
        $this->assertTrue($this->container->has('smoya_omniata.deliverer'));
        $this->assertTrue($this->container->has('smoya_omniata.tracker'));

        $bundleOptions = $this->container->getParameterBag('smoya_omniata')->all();
        $this->assertEquals($parameters['api_key'], $bundleOptions['smoya_omniata.api_key']);
        $this->assertEquals($parameters['tracker']['url'], $bundleOptions['smoya_omniata.tracker.url']);
        $this->assertEquals($parameters['tracker']['timeout'], $bundleOptions['smoya_omniata.tracker.timeout']);
        $this->assertEquals($parameters['deliverer']['url'], $bundleOptions['smoya_omniata.deliverer.url']);
        $this->assertEquals($parameters['deliverer']['timeout'], $bundleOptions['smoya_omniata.deliverer.timeout']);
    }
}
