<?php

namespace SZonov\SlimRouteExport\Postman;

class Request
{
    public $collectionId;
    public $folderId;
    public $id;
    public $name;
    public $description;
    public $url;
    public $method;
    public $headers;
    public $data;
    public $dataMode;

    public function __construct(
        $collectionId,
        $folderId,
        $id,
        $name,
        $description,
        $url,
        $method,
        $headers,
        $data,
        $dataMode
    ) {
        $this->collectionId = $collectionId;
        $this->folderId = $folderId;
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
        $this->method = $method;
        $this->headers = $headers;
        $this->data = $data;
        $this->dataMode = $dataMode;
    }
}
