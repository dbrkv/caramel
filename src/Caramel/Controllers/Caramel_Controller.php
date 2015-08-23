<?php namespace Smartcat\Caramel\Controllers;

use Smartcat\Caramel\Template\ParserFactory;
use Smartcat\Caramel\Caserne\GardeFactory;

/**
 * Class Caramel_Controller
 * @package Smartcat\Caramel\Controllers
 */
abstract class Caramel_Controller extends \CI_Controller
{
    /**
     * Set true if you want use template
     * @var bool
     */
    protected $templated = false;

    /**
     * Set true if you want use garde
     * @var bool
     */
    protected $guarded = false;

    /**
     * Template parser instance
     * @var \Smartcat\Caramel\Template\AbstractParser
     */
    public $template;

    /**
     * Auth library instance
     * @var \Smartcat\Caramel\Caserne\Garde\AbstractGarde
     */
    public $garde;

    /**
     * Caramel_Controller constructor
     */
    public function __construct()
    {
        parent::__construct();

        if ($this->templated) {

            // Load template parser
            $this->template = ParserFactory::make('twig');

        }

        if ($this->guarded) {

            // Load auth library
            $this->garde = GardeFactory::make('sentry');

        }
    }
}