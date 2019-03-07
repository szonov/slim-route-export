# slim-route-export

3 additional endpoints for your slim application under defined root (by default /export).

* /export/documentation.html - html list of routes
* /export/documentation.json - json file for html documentation
* /export/postman.json - can be imported to postman

How to use:

```php
<?php
// vendor should be included
require __DIR__ . '/../vendor/autoload.php';

// Slim app should be created
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

// then you can attach these 3 routes   
(new SZonov\SlimRouteExport\ExportBootstrap('/export'))->__invoke($app);
```
