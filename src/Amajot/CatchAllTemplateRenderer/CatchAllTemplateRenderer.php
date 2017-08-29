<?php

namespace Amajot\CatchAllTemplateRenderer;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Expressive\Template\TemplateRendererInterface;
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

    private $renderer;
    private $path;
    private $extension;

    public function __construct(TemplateRendererInterface $renderer = null, $path, $extension)
    {
        $this->renderer = $renderer;
        $this->path = $path;
        $this->extension = $extension;
    }

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        $uriPath = $request->getUri()->getPath();
        $filePath = ltrim($uriPath, "/");

        if (isset($uriPath)) {

            //Case 1
            //checking for named template directly ex: /app/faq would be app/faq.phtml
            if (is_file($this->path . $uriPath . $this->extension)) {
                return new HtmlResponse($this->renderer->render("app::". $filePath));
            }

            //Case 2
            //checking for template before '/' ex: /app/faq/ template would be app/faq.phtml
            if (is_file($this->path . rtrim($uriPath, "/") . $this->extension)) {
                return new HtmlResponse($this->renderer->render("app::".rtrim($filePath, "/")));
            }

            //Case 3
            //checking for index after '/' ex: /app/faq/ template would be app/faq/index.phtml
            if (substr($uriPath, -1) == '/' && is_file($this->path . $uriPath . 'index' . $this->extension)) {
                return new HtmlResponse($this->renderer->render("app::". $filePath . 'index'));
            }

            //Case4
            //checking for index without '/' ex: /app/faq template would be app/faq/index.phtml
            if (substr($uriPath, -1) != '/' && is_file($this->path . $uriPath . '/index' . $this->extension)) {
                return new HtmlResponse($this->renderer->render("app::". $filePath . '/index'));
            }
        }



        return $delegate->process($request);
    }
}