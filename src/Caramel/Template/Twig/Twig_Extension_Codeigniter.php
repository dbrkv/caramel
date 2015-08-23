<?php
namespace Smartcat\Caramel\Template\Twig;

use Twig_Extension;
use Twig_SimpleFunction;

/**
 * Class Twig_Extention_Codeigniter
 * @package Skyscraper\Templates\Parsers\Twig
 */
class Twig_Extension_Codeigniter extends Twig_Extension
{
    /**
     * Gets the name of the extension
     *
     * @return string
     */
    public function getName()
    {
        return 'codeigniter';
    }

    /**
     * Sets up all of the functions this extension makes available.
     *
     * @return array
     */
    public function getFunctions()
    {
        /**
         * CI Singleton
         * @var object
         */
        $ci =& get_instance();

        $functions = [

            /**
             * ---------------------------------------------------------------
             * Url helper
             * ---------------------------------------------------------------
             */

            'site_url'          => new Twig_SimpleFunction('site_url', 'site_url'),
            'base_url'          => new Twig_SimpleFunction('base_url', 'base_url'),
            'current_url'       => new Twig_SimpleFunction('current_url', 'current_url'),
            'uri_string'        => new Twig_SimpleFunction('uri_string', 'uri_string'),
            'index_page'        => new Twig_SimpleFunction('index_page', 'index_page'),

            /**
             *---------------------------------------------------------------
             * Form helper
             *---------------------------------------------------------------
             */

            'form_open'         => new Twig_SimpleFunction('form_open', 'form_open'),
            'form_close'        => new Twig_SimpleFunction('form_close', 'form_close'),
            'form_dropdown'     => new Twig_SimpleFunction('form_dropdown', 'form_dropdown'),
            'form_multiselect'  => new Twig_SimpleFunction('form_multiselect', 'form_multiselect'),
            'form_radio'        => new Twig_SimpleFunction('form_radio', 'form_radio'),
            'set_value'         => new Twig_SimpleFunction('set_value', 'set_value'),
            'set_select'        => new Twig_SimpleFunction('set_select', 'set_select'),
            'set_checkbox'      => new Twig_SimpleFunction('set_checkbox', 'set_checkbox'),
            'set_radio'         => new Twig_SimpleFunction('set_radio', 'set_radio'),
            'form_error'        => new Twig_SimpleFunction('form_error', 'form_error'),
            'validation_errors' => new Twig_SimpleFunction('validation_errors', 'validation_errors'),

            /**
             * ---------------------------------------------------------------
             * Language helper
             * ---------------------------------------------------------------
             */

            'lang'              => new Twig_SimpleFunction('lang', 'lang'),

            /**
             * ---------------------------------------------------------------
             * Session
             * ---------------------------------------------------------------
             */       
            
            'flash'             => new Twig_SimpleFunction('flash', function() use ($ci) {
                return $ci->session->flashdata('message');
            }),
            
            /**
             * ---------------------------------------------------------------
             * Security
             * ---------------------------------------------------------------
             */

            'csrf_token'        => new Twig_SimpleFunction('csrf_token', function() use ($ci) {
                return $ci->security->get_csrf_hash();
            }),
            'csrf_name'         => new Twig_SimpleFunction('csrf_name', function() use ($ci) {
                return $ci->security->get_csrf_token_name();
            }),

            /**
             * ---------------------------------------------------------------
             * Garde
             * ---------------------------------------------------------------
             */

            'garde_check'       => new Twig_SimpleFunction('garde_check', function() use ($ci) {

                if ( ! isset($ci->garde)) {
                    return FALSE;
                }

                return $ci->garde->check();
            }),
            'authenticated'  => new Twig_SimpleFunction('authenticated', function() use ($ci) {

                if ( ! isset($ci->garde)) {
                    return FALSE;
                }

                return $ci->garde->check();
            }),
        ];


        return $functions;
    }
}