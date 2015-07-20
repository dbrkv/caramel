<?php namespace Smartcat\Caramel\Template;

/**
 * Interface Renderable
 * @package Smartcat\Caramel\Template
 */
interface Renderable {

    /**
     * Render template
     *
     * @param   string  $template
     * @param   array   $data
     * @param   int     $cache_time
     * @return  \CI_Output
     */
    public function render($template, $data = []);
}