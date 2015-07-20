<?php namespace Smartcat\Caramel\Template\Twig;

use Smartcat\Caramel\Exceptions\ParserException;
use Smartcat\Caramel\Template\AbstractParser;
use Smartcat\Caramel\Template\Compilable;
use Twig_Loader_Filesystem;
use Twig_Environment;

/**
 * Class Parser
 * @package Smartcat\Caramel\Template\Twig
 */
class Parser extends AbstractParser implements Compilable
{
    /**
     * Twig parser constructor
     */
    public function __construct()
    {
        parent::__construct();

        $config = $this->get_config();

//        $options = [
//            'template_paths' => $config['template_paths'],
//            'cache' => $config['cache'],
//            'cache_time' => $config['cache_time']
//        ];

        /**
         * Register twig classes
         */
        \Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem($config['template_paths']);
        $twig = new Twig_Environment($loader, $config );

        /**
         * Load Codeigniter Twig extention
         */
        $twig->addExtension(new Twig_Extension_Codeigniter());

        $this->environment = $twig;
    }


    /**
     * Compile template
     *
     * @param   string  $template
     * @param   array   $data
     * @return  string
     */
    public function compile($template, $data = [])
    {
        $extension = '.twig';

        $template .= $extension;

        return parent::compile($template, $data);
    }

    /**
     * Get Twig configuration
     *
     * @return mixed
     * @throws ParserException
     */
    private function get_config()
    {
        $config = config_item('twig');

        /**
         * Paths is required
         */
        if (empty($config) OR ! isset($config['template_paths'])) {
            throw new ParserException ('Configuration for Twig parser not exists!');
        }

        return $config;
    }
}