<?php namespace Smartcat\Caramel\Template;

use Smartcat\Caramel\Exceptions\ParserException;

/**
 * Class ParserFactory
 * @package Smartcat\Caramel\Template
 */
class ParserFactory
{
    /**
     * Parser factory
     *
     * @param $name
     * @return mixed
     * @throws ParserException
     */
    public static function make($name)
    {
        $name = ucfirst($name);
        $class = __NAMESPACE__ . '\\'. $name . '\\Parser';

        if(class_exists($class)) {

            return new $class;

        } else {
            throw new ParserException("Parser \"{$class}\" does not exists!");
        }

    }
}