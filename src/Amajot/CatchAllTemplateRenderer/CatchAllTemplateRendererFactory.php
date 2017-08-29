<?php

namespace Amajot\CatchAllTemplateRenderer;

use Psr\Container\ContainerInterface;
use Zend\Expressive\Template\TemplateRendererInterface;

/**
 * Description of CatchAllTemplateRendererFactory
 *
 * @author amajot
 */
class CatchAllTemplateRendererFactory
{

    /**
     * 
     * @param ContainerInterface $container
     * @return CatchAllTemplateRenderer
     */
    public function __invoke(ContainerInterface $container)
    {
        $config   = $container->has('config') ? $container->get('config') : [];
        $renderer = $container->has(TemplateRendererInterface::class)
            ? $container->get(TemplateRendererInterface::class)
            : null;
        //$template = $this->getPlatesEngine($config['templates']);
        //return new NotFoundDelegate(new Response(), $renderer, $template);
        return new CatchAllTemplateRenderer($renderer, $config["templates"]['paths'][$config['templates']["catchall_template_directory"]][0], ".".$config["templates"]["extension"]);
    }
}