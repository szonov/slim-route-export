<?php

namespace SZonov\SlimRouteExport\Postman;

class Folder
{
    public $id;
    public $name;
    public $description;
    public $order = [];

    public function __construct($id, $name, $description = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    public function addRequestId($requestId)
    {
        $this->order[] = $requestId;
        return $this;
    }
}
