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
        $action = "{$http_method}_$route";

        if (method_exists($this, $action)) {
            return $this->$action();
        }

        if (method_exists($this, $route)) {
            return $this->$route();
        }

        redirect(404);
    }
}