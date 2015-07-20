<?php namespace Smartcat\Caramel\Controllers;

use Smartcat\Caramel\Caserne\Garde\AbstractGarde;
use Smartcat\Caramel\Caserne\GardeFactory;

/**
 * Class Base_Controller
 * @package Smartcat\Caramel\Controllers
 */
class Base_Controller extends \CI_Controller
{
    /**
     * Garde
     * @var AbstractGarde
     * @access: public
     */
    public $garde;

    /**
     * Base controller constructor
     */
    function __construct()
    {
        parent::__construct();

        $this->garde = GardeFactory::make('sentry');
    }
}