<?php namespace Smartcat\Caramel\Caserne;

use Smartcat\Caramel\Caserne\Garde\AbstractGarde;
use Smartcat\Caramel\Exceptions\GardeException;

/**
 * Class GardeFactory
 * @package Smartcat\Garde
 */
class GardeFactory {

    /**
     * Make new garde
     *
     * @param  $name
     * @return AbstractGarde
     * @throws GardeException
     */
    public static function make($name)
    {
        $name = ucfirst($name);
        $class = __NAMESPACE__ . '\\Garde\\' . $name;

        if(class_exists($class)) {

            return new $class;

        } else {

            throw new GardeException("Garde \"{$class}\" does not exists!");
        }
    }
}