<?php

namespace SZonov\SlimRouteExport\Helpers;

use Slim\Route;
use Slim\Container;

class InfoHelper implements InfoHelperInterface
{
    /**
     * @var Container
     */
    protected $container;

    protected $title;
    protected $description;
    protected $basePath;


    /**
     * @var Route
     */
    protected $route;

    /**
     * Two elements:
     *  0 - group name
     *  1 - group description
     *
     * @var array
     */
    protected $group = [];

    protected $groups = [];
    protected $routes = [];

    public function __construct(Container $container, $title = null, $description = null, $basePath = null)
    {
        $this->container = $container;
        $this->title = $title ?? 'API';
        $this->description = $description ?? 'Rest api overview';
        $this->basePath = rtrim($basePath ?? $this->container->request->getUri()->withPath('/'), '/');
    }

    /**
     * Returns title of application
     *
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * Returns description of application
     *
     * @return string
     */
    public function description()
    {
        return $this->description;
    }

    /**
     * Returns base path of api
     *
     * @return string
     */
    public function basePath()
    {
        return $this->basePath;
    }

    /**
     * Setup currently used route
     *
     * @param Route $route
     * @return InfoHelper
     */
    public function with(Route $route)
    {
        $groupPattern = join('', array_map(function($group) { return $group->getPattern(); }, $route->getGroups()));

        $group = $this->groups[$groupPattern] ?? [ $groupPattern ];

        $this->group = (array)$group;
        $this->route = $route;

        return $this;
    }

    /**
     * Returns currently used route
     *
     * @return Route
     */
    public function route()
    {
        return $this->route;
    }

    /**
     * Returns name of group/collection
     *
     * @return string
     */
    public function groupName()
    {
        return $this->group[0] ?? '';
    }

    /**
     * Returns description of group/collection
     *
     * @return string
     */
    public function groupDescription()
    {
        return $this->group[1] ?? null;
    }

    /**
     * Returns name of route for defined http method
     *
     * @param string $method Http method
     * @return string
     */
    public function routeName($method)
    {
        return $this->route->getName() ?? '';
    }

    /**
     * Returns description of route for defined http method
     *
     * @param string $method Http method
     * @return string
     */
    public function routeDescription($method)
    {
        $pattern = $this->route->getPattern();
        return $this->routes[$method . ' ' . $pattern] ?? $this->routes[$pattern] ?? null;
    }

    /**
     * Return list of headers that should be added to postman's json
     *
     * @return mixed
     */
    public function additionalHeader()
    {
        return 'Authorization: Bearer {{authToken}}';
    }

    /**
     * Returns list of roles allowed for current route and method
     *
     * @param string $method
     * @return array
     */
    public function allowedRoles($method)
    {
        return [];
    }
}
