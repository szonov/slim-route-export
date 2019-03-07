<?php

namespace SZonov\SlimRouteExport\Postman;

use SZonov\SlimRouteExport\Helpers\RouteCollector;

class Postman extends RouteCollector
{
    public $id;
    public $name;
    public $description;
    public $order = [];

    public $folders  = [];
    public $requests = [];

    private $basePath;

    protected function initialize()
    {
        $this->id = $this->uuid();
        $this->name = $this->info->title();
        $this->basePath = $this->info->basePath();
    }

    protected function uuid()
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff),

            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),

            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,

            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,

            // 48 bits for "node"
            mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    public function createCollection()
    {
        $folder = new Folder($this->uuid(), $this->info->groupName(), $this->info->groupDescription());
        $this->folders[] = $folder;
        return $folder;
    }

    /**
     * @param string $method
     * @param Folder $folder
     */
    public function createItem($method, $folder)
    {
        $route = $this->info->route();

        $request = new Request(
            $this->id,
            $folder->id,
            $this->uuid(),
            $route->getPattern(),
            $this->info->routeDescription($method),
            $this->basePath . $route->getPattern(),
            $method,
             $this->info->additionalHeader(),
            null,
            "raw"
        );

        $this->requests[] = $request;
        $folder->addRequestId($request->id);
    }
}
