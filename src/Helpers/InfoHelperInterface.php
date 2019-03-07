<?php

namespace SZonov\SlimRouteExport\Helpers;

use Slim\Route;

interface InfoHelperInterface
{
    /**
     * Returns title of application
     *
     * @return string
     */
    public function title();

    /**
     * Returns description of application
     *
     * @return string
     */
    public function description();

    /**
     * Returns base path of api
     *
     * @return string
     */
    public function basePath();

    /**
     * Setup currently used route
     *
     * @param Route $route
     * @return InfoHelperInterface
     */
    public function with(Route $route);

    /**
     * Returns currently used route
     *
     * @return Route
     */
    public function route();

    /**
     * Returns name of group/collection
     *
     * @return string
     */
    public function groupName();

    /**
     * Returns description of group/collection
     *
     * @return string
     */
    public function groupDescription();

    /**
     * Returns name of route for defined http method
     *
     * @param string $method Http method
     * @return string
     */
    public function routeName($method);

    /**
     * Returns description of route for defined http method
     *
     * @param string $method Http method
     * @return string
     */
    public function routeDescription($method);

    /**
     * Return list of headers that should be added to postman's json
     *
     * @return mixed
     */
    public function additionalHeader();

    /**
     * Returns list of roles allowed for current route and method
     *
     * @param string $method
     * @return array
     */
    public function allowedRoles($method);
}
