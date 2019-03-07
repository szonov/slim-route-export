<?php

namespace SZonov\SlimRouteExport\Documentation;

class Collection
{
    public $name;
    public $description;
    public $endpoints = [];

    public function __construct($name, $description = null)
    {
        $this->name = $name;
        $this->description = $description;
    }

    public function addEndpoint(Endpoint $endpoint)
    {
        $this->endpoints[] = $endpoint;
    }
}
