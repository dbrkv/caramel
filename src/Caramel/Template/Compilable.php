<?php namespace Smartcat\Caramel\Template;

/**
 * Interface Compilable
 * @package Smartcat\Caramel\Template
 */
interface Compilable
{
    /**
     * Compile template into html code
     *
     * @param   string  $template
     * @param   array   $data
     * @return  string
     */
    public function compile($template, $data);
}