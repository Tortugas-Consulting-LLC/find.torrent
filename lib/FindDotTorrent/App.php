<?php

namespace FindDotTorrent;

class App extends \Bullet\App
{
    public function __construct()
    {
        $dir_config = __DIR__ . '/../../src/config';
        $dir_routes = __DIR__ . '/../../src/routes';

        $config = parse_ini_file($dir_config .'/config.ini');

        parent::__construct($config);

        // In our closures and our route files we reference $app which is just
        // this object. Make this association for convenience and clarity;
        $app = $this;

        foreach (glob($dir_routes . "/*.php") as $filename) {
            require $filename;
        }

        $this->registerResponseHandler(
            function($response) {
                return $response->content() instanceof \NoCarrier\Hal;
            },
            function($response) use($app) {
                if ('xml' === strtolower($app['response_format'])) {
                    $response->content($response->content()->asXml());
                    $response->contentType('application/hal+xml');
                } else {
                    $response->content($response->content()->asJson());
                    $response->contentType('application/hal+json');
                }
            }
        );

        $this['HalHandler'] = function($app) {
            return new \FindDotTorrent\HalHandler($app);
        };
   }
}
