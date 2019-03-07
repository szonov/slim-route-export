<?php

namespace SZonov\SlimRouteExport\Documentation;

class Endpoint
{
    public $name;
    public $description;
    public $httpMethod;
    public $path;

    public $allowedRoles = [];

    public function __construct($name, $description, $httpMethod, $path, $allowedRoles = [])
    {
        $this->name = $name;
        $this->description = $description;
        $this->httpMethod = $httpMethod;
        $this->path = $path;
        $this->allowedRoles = $allowedRoles;
    }
}
