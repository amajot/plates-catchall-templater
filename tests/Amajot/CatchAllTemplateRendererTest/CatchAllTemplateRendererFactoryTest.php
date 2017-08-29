<?php

namespace Amajot\CatchAllTemplateRenderer;

use Amajot\CatchAllTemplateRenderer\CatchAllTemplateRenderer;
use Amajot\CatchAllTemplateRenderer\CatchAllTemplateRendererFactory;
use Interop\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
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

        $plates = $this->prophesize(TemplateRendererInterface::class);

        $this->container->has('config')->willReturn(true);
        $this->container->has(TemplateRendererInterface::class)->willReturn(true);
        $this->container->get('config')->willReturn(array('templates' => 
        array("extension"=>"phtml", "catchall_template_directory"=>"app", "paths"=> array("app"=>array("template")))));
        $this->container->get(TemplateRendererInterface::class)->willReturn($plates);

        $this->assertInstanceOf(CatchAllTemplateRendererFactory::class, $factory);


        $catchAll = $factory($this->container->reveal());

        $this->assertInstanceOf(CatchAllTemplateRenderer::class, $catchAll);
    }
/*
    public function testFactoryWithTemplateOverrideDirectory()
    {
        $factory = new CatchAllTemplateRendererFactory();
        $this->container->get('config')->willReturn(array('templates' => 
                array("extension"=>"phtml",'catchall_template_directory' => "catchall_template_directory", 'paths'=> array("namespace"=>"path"))));
        $this->assertInstanceOf(CatchAllTemplateRendererFactory::class, $factory);

        $plates = $this->prophesize(Engine::class);
        $plates
                ->setFileExtension(Argument::type('String'))
                ->willReturn(true);
        $plates
                ->setDirectory(Argument::type('String'))
                ->willReturn(true);
        $plates
                ->getDirectory()
                ->willReturn(false);
        $plates
                ->addFolder(Argument::type('String'), Argument::type('String'), true)
                ->willReturn(false);

        $factory->setPlatesEngine($plates->reveal());

        $catchAll = $factory($this->container->reveal());

        $this->assertInstanceOf(CatchAllTemplateRenderer::class, $catchAll);
    }*/
}
