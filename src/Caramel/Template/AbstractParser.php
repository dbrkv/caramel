<?php namespace Smartcat\Caramel\Template;

/**
 * Class AbstractParser
 * @package Smartcat\Caramel\Template
 */
class AbstractParser implements Renderable, Compilable
{
    /**
     * Codeigniter instance
     * @var object
     */
    protected $ci;

    /**
     * Parser object
     * @var object
     */
    protected $environment;


    /**
     * AbstractParser class constructor
     */
    public function __construct()
    {
        $this->ci =& get_instance();

        $this->ci->load->helper('url');
        $this->ci->load->helper('form');
        $this->ci->load->library('session');
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
        $html = $this->environment->render($template, $data);

        return $html;
    }

    /**
     * Render template
     *
     * Render template with parser and save html to cache if needed
     *
     * @param   string  $template
     * @param   array   $data
     * @param   string  $content_type
     * @param   int     $cache_time
     * @return \CI_Output
     */
    public function render($template, $data = [], $content_type = 'html')
    {
        // Get flash notification
        $data['flash'] = $this->flash();

        $html = $this->compile($template, $data);

         return $this->ci->output
                        ->set_content_type($content_type)
                        ->set_output($html);
    }

    /**
     * Set flash message to CI session
     *
     * @param string $message
     * @param string $type
     */
    public function set_flash($message = '', $type = 'info')
    {
        $data = [
            'message' => $message,
            'type' => $type
        ];

        $this->ci->session->set_flashdata('message', $data);

        return $this;
    }

    /**
     * Get flash message from CI session
     *
     * @return array
     */
    public function flash()
    {
        $message = $this->ci->session->flashdata('message');

        return $message;
    }

}