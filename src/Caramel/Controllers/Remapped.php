<?php namespace Smartcat\Caramel\Controllers;

/**
 * Class Remapped
 * @package Smartcat\Caramel\Controllers
 */
trait Remapped
{
    /**
     * Remap routes
     *
     * Codeigniter controller routes RESTful remap
     *
     * @return mixed
     */
    public function _remap()
    {
        $route = singular($this->router->uri->rsegments[1]);
        $http_method = $this->input->method();
        $params = array_slice($this->router->uri->rsegments, 1, 1); // Third uri segment is resource $id

        if ( ! is_null($this->input->post('_method')) ) {
            $http_method = strtolower($this->input->post('_method'));
        }

        // http://resource/1/edit
        if ( end($this->router->uri->segments) === 'edit') {
            $http_method = 'edit';
        }

        $action = "{$http_method}_$route";

        if (method_exists($this, $action)) {
            return $this->{$action}($params);
        }

        if (method_exists($this, $route)) {
            return $this->{$route}($params);
        }

        redirect(404);
    }
}