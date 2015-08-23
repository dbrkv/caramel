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
        $http_method = $this->input->method();
        $route = $this->router->method;
//        $action = "{$http_method}_$route";
        $params = array_slice($this->router->uri->rsegments, 2);

        // We are use PUT, PATCH, DELETE methods
        if ( ! is_null($this->input->post('_method'))) {
            $http_method = strtolower($this->input->post('_method'));
            $route = isset($this->router->uri->rsegments[2]) ? $this->router->uri->rsegments[2] : $this->router->uri->rsegments[1];
        }

        // Second segment is numeric
        if (is_numeric($route)) {

            $route = singular($this->router->uri->rsegments[1]);

            if (end($this->router->uri->segments) === 'edit') {
                $http_method = 'edit';
            }

            $action = "{$http_method}_$route";
            $params = array_slice($this->router->uri->rsegments, 1, 1); // Third uri segment is resource $id

            $params = $params[0];

        }
        
        if ($route === 'create') {
            $http_method = 'create';
            $route = singular($this->router->class);
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