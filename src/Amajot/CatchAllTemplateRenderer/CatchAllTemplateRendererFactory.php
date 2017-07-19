<?php

namespace Amajot\CatchAllTemplateRenderer;

use Interop\Container\ContainerInterface;
use League\Plates\Engine;

/**
 * Description of CatchAllTemplateRendererFactory
 *
 * @author amajot
 */
class CatchAllTemplateRendererFactory
{

    private $platesEngine;

    /**
     * 
     * @param ContainerInterface $container
     * @return CatchAllTemplateRenderer
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');
        return new CatchAllTemplateRenderer($this->getPlatesEngine($config['templates']));
    }

    /**
     * 
     * @param Array $config Template specific config info
     * @return type PlatesEngine
     * 
     * 
     */
    private function getPlatesEngine($config)
    {
        if ($this->platesEngine == null) {
            $this->platesEngine = new Engine();
        }
        $this->platesEngine->setFileExtension($config['extension']);

        $allPaths = isset($config['paths']) && is_array($config['paths']) ? $config['paths'] : [];
        foreach ($allPaths as $namespace => $paths) {
            $namespace = is_numeric($namespace) ? null : $namespace;
            foreach ((array) $paths as $path) {
                if (!$this->platesEngine->getDirectory()) {
                    $this->setPlatesEngineDirectory($path, $config);
                }
                $this->platesEngine->addFolder($namespace, $path, true);
            }
        }
        
        return $this->platesEngine;
    }

    private function setPlatesEngineDirectory($path, $config){
        if(isset($config["catchall_template_directory"])){
            $this->platesEngine->setDirectory($config["catchall_template_directory"]);
        }
        else{
            $this->platesEngine->setDirectory($path);
        }

    }

    public function setPlatesEngine(Engine $platesEngine)
    {
        $this->platesEngine = $platesEngine;
    }
}
