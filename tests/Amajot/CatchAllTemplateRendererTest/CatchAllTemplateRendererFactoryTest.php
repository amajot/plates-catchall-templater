<?php

namespace Amajot\CatchAllTemplateRenderer;

use Amajot\CatchAllTemplateRenderer\CatchAllTemplateRenderer;
use Amajot\CatchAllTemplateRenderer\CatchAllTemplateRendererFactory;
use Interop\Container\ContainerInterface;
use League\Plates\Engine;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;

/**
 * Description of CatchAllTemplateRendererFactoryTest
 *
 * @author amajot
 */
class CatchAllTemplateRendererFactoryTest extends TestCase
{

    /** @var ContainerInterface */
    protected $container;

    protected function setUp()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
    }

    public function testFactoryWithTemplate()
    {
        $factory = new CatchAllTemplateRendererFactory();
        $this->container->get('config')->willReturn(array('templates' => array()));

        $this->assertInstanceOf(CatchAllTemplateRendererFactory::class, $factory);

        $plates = $this->prophesize(Engine::class);
        $plates
                ->setFileExtension(Argument::type('String'))
                ->willReturn(true);
        $plates
                ->setDirectory(Argument::type('String'))
                ->willReturn(true);

        $factory->setPlatesEngine($plates->reveal());

        $catchAll = $factory($this->container->reveal());

        $this->assertInstanceOf(CatchAllTemplateRenderer::class, $catchAll);
    }
}
