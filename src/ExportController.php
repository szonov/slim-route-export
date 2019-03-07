<?php

namespace SZonov\SlimRouteExport;

use SZonov\SlimRouteExport\Documentation\Documentation;
use SZonov\SlimRouteExport\Helpers\InfoHelper;
use SZonov\SlimRouteExport\Helpers\InfoHelperInterface;
use SZonov\SlimRouteExport\Postman\Postman;
use Slim\Container;
use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class ExportController
 * @package SZonov\SlimRouteExport
 *
 */
class ExportController
{
    /**
     * @var Container
     */
    protected $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function documentationHtml(Request $request, Response $response)
    {
        $view = new \Slim\Views\PhpRenderer(__DIR__ . '/Views/');
        $info = $this->getInfoHelper();
        return $view->render($response, 'documentation.phtml', [
            'title' => $info->title(),
            'description' => $info->description()
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function documentationJson(Request $request, Response $response)
    {
        return $response->withJson(new Documentation($this->getInfoHelper(), $this->getRoutes()));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws \Interop\Container\Exception\ContainerException
     */
    public function postmanJson(Request $request, Response $response)
    {
        return $response->withJson(new Postman( $this->getInfoHelper(), $this->getRoutes() ));
    }

    /**
     * @return InfoHelperInterface
     * @throws \Interop\Container\Exception\ContainerException
     */
    private function getInfoHelper()
    {
        $info = $this->container->has('exportInfoHelper') ? $this->container->get('exportInfoHelper') : null;
        return ($info instanceof InfoHelperInterface) ? $info : new InfoHelper($this->container);
    }

    /**
     * @return \Slim\Route[]
     */
    private function getRoutes()
    {
        /** @var \Slim\Router $router */
        $router = $this->container->router;
        return $router->getRoutes();
    }
}
