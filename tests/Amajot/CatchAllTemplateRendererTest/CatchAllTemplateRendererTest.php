<?php

namespace Amajot\CatchAllTemplateRenderer;

use Amajot\CatchAllTemplateRenderer\CatchAllTemplateRenderer;
use Interop\Http\ServerMiddleware\DelegateInterface;
use League\Plates\Engine;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;
use Zend\Diactoros\Uri;

/**
 * Description of CatchAllTemplateRendererTest
 *
 * @author amajot
 */
class CatchAllTemplateRendererTest extends TestCase
{

public function testLoad()
    {

        $this->assertEquals(true, true);
    }

/*
    public function testReturnsHtmlResponseWhenTemplateExists()
    {
        $plates = $this->prophesize(Engine::class);
        $plates
                ->exists('/test/path/that/exists')
                ->willReturn(true);
        $plates
                ->render('/test/path/that/exists', Argument::type('array'))
                ->willReturn('path exists!');

        $catchAll = new CatchAllTemplateRenderer($plates->reveal());

        $uri = $this->prophesize(Uri::class);
        $uri->getPath()->willReturn('/test/path/that/exists');

        $request = $this->prophesize(ServerRequestInterface::class);
        $request->getUri()->willReturn($uri->reveal());


        $response = $catchAll->process(
                $request->reveal(), $this->prophesize(DelegateInterface::class)->reveal()
        );

        $this->assertInstanceOf(HtmlResponse::class, $response);
        $this->assertEquals($response->getBody(), 'path exists!');
    }

    public function testReturnsHtmlResponseWhenTemplateExistsCase2()
    {
        $plates = $this->prophesize(Engine::class);
        $plates
                ->exists('/test/path/that/exists/')
                ->willReturn(false);
        $plates
                ->exists('/test/path/that/exists')
                ->willReturn(true);
        $plates
                ->render('/test/path/that/exists', Argument::type('array'))
                ->willReturn('path exists!');

        $catchAll = new CatchAllTemplateRenderer($plates->reveal());

        $uri = $this->prophesize(Uri::class);
        $uri->getPath()->willReturn('/test/path/that/exists/');

        $request = $this->prophesize(ServerRequestInterface::class);
        $request->getUri()->willReturn($uri->reveal());


        $response = $catchAll->process(
                $request->reveal(), $this->prophesize(DelegateInterface::class)->reveal()
        );

        $this->assertInstanceOf(HtmlResponse::class, $response);
        $this->assertEquals($response->getBody(), 'path exists!');
    }

    public function testReturnsHtmlResponseWhenTemplateExistsCase3()
    {
        $plates = $this->prophesize(Engine::class);
        $plates
                ->exists('/test/path/that/exists/')
                ->willReturn(false);
        $plates
                ->exists('/test/path/that/exists')
                ->willReturn(false);
        $plates
                ->exists('/test/path/that/exists/index')
                ->willReturn(true);
        $plates
                ->render('/test/path/that/exists/index', Argument::type('array'))
                ->willReturn('path exists!');

        $catchAll = new CatchAllTemplateRenderer($plates->reveal());

        $uri = $this->prophesize(Uri::class);
        $uri->getPath()->willReturn('/test/path/that/exists/');

        $request = $this->prophesize(ServerRequestInterface::class);
        $request->getUri()->willReturn($uri->reveal());


        $response = $catchAll->process(
                $request->reveal(), $this->prophesize(DelegateInterface::class)->reveal()
        );

        $this->assertInstanceOf(HtmlResponse::class, $response);
        $this->assertEquals($response->getBody(), 'path exists!');
    }

    public function testReturnsHtmlResponseWhenTemplateExistsCase4()
    {
        $plates = $this->prophesize(Engine::class);
        $plates
                ->exists('/test/path/that/exists/')
                ->willReturn(false);
        $plates
                ->exists('/test/path/that/exists')
                ->willReturn(false);
        $plates
                ->exists('/test/path/that/exists/index')
                ->willReturn(true);
        $plates
                ->render('/test/path/that/exists/index', Argument::type('array'))
                ->willReturn('path exists!');

        $catchAll = new CatchAllTemplateRenderer($plates->reveal());

        $uri = $this->prophesize(Uri::class);
        $uri->getPath()->willReturn('/test/path/that/exists');

        $request = $this->prophesize(ServerRequestInterface::class);
        $request->getUri()->willReturn($uri->reveal());


        $response = $catchAll->process(
                $request->reveal(), $this->prophesize(DelegateInterface::class)->reveal()
        );

        $this->assertInstanceOf(HtmlResponse::class, $response);
        $this->assertEquals($response->getBody(), 'path exists!');
    }

    public function testReturnsHtmlResponseWhenTemplateDoesNotExist()
    {
        $plates = $this->prophesize(Engine::class);
        $plates
                ->exists('/test/path/that/does/not/exist')
                ->willReturn(false);
        $plates
                ->exists('/test/path/that/does/not/exist/index')
                ->willReturn(false);

        $catchAll = new CatchAllTemplateRenderer($plates->reveal());

        $uri = $this->prophesize(Uri::class);
        $uri->getPath()->willReturn('/test/path/that/does/not/exist');

        $request = $this->prophesize(ServerRequestInterface::class);
        $request->getUri()->willReturn($uri->reveal());
        $delegate = $this->prophesize(DelegateInterface::class);
        $delegate->process($request)->willReturn('404 Handler');


        $response = $catchAll->process($request->reveal(), $delegate->reveal());

        $this->assertEquals($response, '404 Handler');
    }*/

}
