<?php

namespace amajot\CatchAllTemplateRenderer;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\HtmlResponse;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CatchAllTemplateRenderer
 *
 * @author amajot
 */
class CatchAllTemplateRenderer implements MiddlewareInterface
{

    private $platesEngine;

    public function __construct(Engine $platesEngine)
    {
        $this->platesEngine = $platesEngine;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $uriPath = $request->getUri()->getPath();

        if (isset($uriPath)) {

            //Case 1
            //checking for named template directly ex: /app/faq would be app/faq.phtml
            if ($this->platesEngine->exists($uriPath)) {
                return new HtmlResponse($this->platesEngine->render($uriPath, []));
            }

            //Case 2
            //checking for template before '/' ex: /app/faq/ template would be app/faq.phtml
            if ($this->platesEngine->exists(rtrim($uriPath, "/"))) {
                return new HtmlResponse($this->platesEngine->render(rtrim($uriPath, "/"), []));
            }

            //Case 3
            //checking for index after '/' ex: /app/faq/ template would be app/faq/index.phtml
            if (substr($uriPath, -1) == '/' && $this->platesEngine->exists($uriPath . 'index')) {
                return new HtmlResponse($this->platesEngine->render($uriPath . 'index', []));
            }

            //Case4
            //checking for index without '/' ex: /app/faq template would be app/faq/index.phtml
            if (substr($uriPath, -1) != '/' && $this->platesEngine->exists($uriPath . '/index')) {
                return new HtmlResponse($this->platesEngine->render($uriPath . '/index', []));
            }
        }



        return $delegate->process($request);
    }
}
