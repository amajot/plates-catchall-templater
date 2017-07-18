# plates-catchall-templater
[![Build Status](https://travis-ci.org/amajot/plates-catchall-templater.svg?branch=master)](https://travis-ci.org/amajot/plates-catchall-templater)

middleware that will render templates without predefined routes or actions

## Installation

Install this library using composer:

```bash
$ composer require amajot/plates-catchall-templater
```

Add a factory in dependencies.global.php

```bash
Amajot\CatchAllTemplateRenderer\CatchAllTemplateRenderer::class => Amajot\CatchAllTemplateRenderer\CatchAllTemplateRendererFactory::class,
```

Add the Middleware in the pipeline before the 404 handler

```bash
use Amajot\CatchAllTemplateRenderer\CatchAllTemplateRenderer;
...
// At this point, if no Response is return by any middleware, the
// NotFoundHandler kicks in; alternately, you can provide other fallback
// middleware to execute.
$app->pipe(CatchAllTemplateRenderer::class);
$app->pipe(NotFoundHandler::class);

```
