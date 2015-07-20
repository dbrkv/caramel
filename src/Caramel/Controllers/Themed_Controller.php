<?php namespace Smartcat\Caramel\Controllers;
/**
 * Created by PhpStorm.
 * User: Dmitry
 * Date: 12.07.2015
 * Time: 18:18
 */

use Smartcat\Caramel\Template\AbstractParser;
use Smartcat\Caramel\Template\ParserFactory;

/**
 * Class Themed_Controller
 * @package Smartcat\Caramel\Controllers
 */
class Themed_Controller extends Base_Controller
{
    /**
     * Parser instance
     * @var AbstractParser
     * @access: public
     */
    public $template;

    /**
     * Themed Controller constructor
     *
     * @throws \Smartcat\Caramel\Exceptions\ParserException
     */
    public function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->template = ParserFactory::make('twig');
    }
}