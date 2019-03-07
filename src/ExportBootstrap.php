<?php

namespace SZonov\SlimRouteExport;

use \Slim\App;

/**
 * You should call this bootstrap file to attach needed route to your slim application
 *
 * For example:
 *   // you have defined Slim app
 *   $app = new \Slim\App;
 *
 *   // you can call in this way:
 *   $export = new \SZonov\SlimRouteExport\ExportBootstrap;
 *   $export($app);
 *
 *   // or you can call in one line:
 *   (new SZonov\SlimRouteExport\ExportBootstrap('/docs'))->__invoke($app);
 *
 */
class ExportBootstrap
{
    private $pattern;

    public function __construct($pattern = '/export')
    {
        $this->pattern = $pattern;
    }

    public function __invoke(App $api)
    {
        // Документация
        $api->group($this->pattern, function (App $api) {
            $api->get('/documentation.html', ExportController::class . ':documentationHtml');
            $api->get('/documentation.json', ExportController::class . ':documentationJson');
            $api->get('/postman.json', ExportController::class . ':postmanJson');
        });
    }
}
