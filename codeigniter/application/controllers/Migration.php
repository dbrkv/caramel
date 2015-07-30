<?php

/**
 * Class Migration
 *
 * DB migrations controller
 * @see: http://www.codeigniter.com/user_guide/libraries/migration.html
 */
class Migration extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

        if ( ! $this->input->is_cli_request()) {
            die('CLI only!');
        }
    }

    /**
     * Migrations controller root
     */
    public function index()
    {
        $this->load->library('migration');

        /**
         * Check migrations state
         */
        if ($this->migration->current() === FALSE)
        {
            show_error($this->migration->error_string());
        }
    }
}