<?php namespace Smartcat\Caramel\Controllers;

use Smartcat\Caramel\Template\ParserFactory;
use Smartcat\Caramel\Caserne\GardeFactory;

/**
 * Class Caramel_Controller
 * @package Smartcat\Caramel\Controllers
 */
class Caramel_Controller extends \CI_Controller
{
    /**
     * Set true if you want use template
     * @var bool
     */
    protected $themed = false;

    /**
     * Set true if you want use garde
     * @var bool
     */
    protected $garded = false;

    /**
     * Class constructor
     */
    public function __construct()
    {
        parent::__construct();

        if ($this->themed) {
            $this->template = ParserFactory::make('twig');
        }

        if ($this->garded) {
            $this->garde = GardeFactory::make('sentry');
        }
    }
}