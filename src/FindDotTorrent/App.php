<?php

namespace FindDotTorrent;

use Bullet\Request as Request;
use Bullet\Response;
use FindDotTorrent\FeedHandler as FeedHandler;
use FindDotTorrent\HalHandler as HalHandler;
use NoCarrier\Hal;
use PDO as PDO;

class App extends \Bullet\App
{
    public function __construct()
    {
        $dir_config = __DIR__ . '/../../app/config';
        $dir_routes = __DIR__ . '/../../app/routes';

        $config = parse_ini_file($dir_config . '/config.ini');

        $config['template.cfg'] = array(
            'path' => __DIR__ . '/../../app/templates/',
            'path_layouts' => __DIR__ . '/../../app/templates/layouts/'
        );

        parent::__construct($config);

        // In our closures and our route files we reference $app which is just
        // this object. Make this association for convenience and clarity;
        $app = $this;

        foreach (glob($dir_routes . "/*.php") as $filename) {
            require $filename;
        }

        $this->registerResponseHandler(
        // Condition check
            function ($response) {
                /**
                 * @var Response $response
                 */
                return $response->content() instanceof Hal;
            },
            // Response modifier
            function ($response) use ($app) {
                /**
                 * @var Response $response ->content()
                 */
                if ('xml' === strtolower($app['response_format'])) {
                    $response->content($response->content()->asXml());
                    $response->contentType('application/hal+xml');
                } else {
                    $response->content($response->content()->asJson());
                    $response->contentType('application/hal+json');
                }
            }
        );

        $this['db'] = $this->share(function ($app) {
            return new PDO($app["db_dsn"], $app["db_username"], $app["db_password"]);
        });

        $this['HalHandler'] = function ($app) {
            return new HalHandler($app);
        };

        $this['FeedHandler'] = function ($app) {
            return new FeedHandler($app['db']);
        };

        $this['KeyHandler'] = function ($app) {
            return new KeyHandler($app['db']);
        };
    }

    /**
     * Parses a request and determines if it is authenticated.
     *
     * Returns boolean true on success or a string error message on failure
     * @param Request $request
     * @return bool|string
     */
    public function requestIsAuthenticated(Request $request)
    {
        // Look for public key, content hash, and request timestamp headers.
        $public_key = $request->header("X-Public-Key");
        if (false === $public_key) {
            return 'Missing required "X-Public-Key" header.';
        }
        $content_hash = $request->header("X-Content-Hash");
        if (false === $content_hash) {
            return 'Missing required "X-Content-Hash" header.';
        }
        $request_timestamp = $request->header("X-Request-Timestamp");
        if (false === $request_timestamp) {
            return 'Missing required "X-Request-Timestamp" header.';
        }

        // Identify API private key based on public key.
        /** @var Key $key_store */
        $key_store = $this["KeyHandler"]->findByPublicKey($public_key);
        if (false === $key_store) {
            return 'Unable to authenticate provided X-Public-Key';
        }

        // Ensure that the hash of public key, request timestamp and optionally
        // the request body match the provided content hash.
        $hash_basis = $public_key . $request_timestamp . $request->raw();

        if (hash_hmac("sha256", $hash_basis, $key_store->getPrivateKey()) != $content_hash) {
            return 'Provided content hash did not match expected value.';
        }

        return true;
    }
}
