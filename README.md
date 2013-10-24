![find.torrent](assets/img/logo-180.png)

find.torrent
===========
find.torrent is a service to facilitate the discovery and downloading of torrent files to a home server or leachbox. The service provides a REST API for searching configured torrent RSS feeds and triggering a file download at the server. Neither the torrent file nor its indicated content is returned to the client; the .torrent file is simply downloaded to a configured location at the server. Another service such as [Transmission](http://www.transmissionbt.com/) needs to be running on the server to process the downloaded .torrents for any additional action to be taken.

Requirements
------------
* PHP 5.3+
* Apache with mod_rewrite (or equivalent)
* Composer for dependency management
    * Install with `curl -s http://getcomposer.org/installer | php`

Installation
------------
1. Clone this repo
2. Install dependencies
    * Run `php composer.phar install`
3. Create a database with the schema file at `db/install.sql`

Configuration
-------------
Copy `src/config/config.example.ini` to `src/config/config.ini` and fill in the blanks.

API Documentation
-----------------
Documentation of the service endpoints can be found by browsing to `/rels/`. API reponses use the CURIE syntax to show where to find documentation for a specific resource.

Responses are in either [application/hal+json or application/hal+xml](http://stateless.co/hal_specification.html) depending on your `config.ini`.

API requests use a simple Public Key / Shared Secret Key hashing method for authentication. Create a key pair on the server using the console interface by running `php -f src/console.php api-key:create`. Store these two values in the config for your application. When making requests send the following headers:

* **X-Public-Key**: The public key to identify the requester
* **X-Request-Timestamp**: A date/time string or unix timestamp to uniquely identify the request. Protects against replay attacks.
* **X-Content-Hash**: A SHA256 hash of (in this order) the public key, the request timestamp value, and the request body (if any). This has should be generated using the private key.

An example request is shown below. This comes mainly from [Chris Cornutt on websec.io](http://websec.io/2013/02/14/API-Authentication-Public-Private-Key.html).
~~~ php
<?php

$public_key  = "1fcdc1456ccfc1f4d849a8d66f14d12874e8d5befcaac9498b528758f60155c0";
$private_key = "c0131b57c734cb7a7ff0b951405b9899fb8ccc2971da102a823f8c6386ce5025";

$request_timestamp = microtime();

$body = json_encode(array(
    "foo" => "bar"
));

$hash_basis = $public_key . $request_timestamp . $body;
$hash = hash_hmac("sha256", $hash_basis, $private_key);

$headers = array(
    "X-Public-Key: {$public_key}",
    "X-Request-Timestamp: {$request_timestamp}",
    "X-Content-Hash: {$hash}"
);

$ch = curl_init("http://localhost:8001/about");

curl_setopt($ch, CURLOPT_HTTPHEADER,     $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS,     $body);

$result = curl_exec($ch);
$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

curl_close($ch);

if (200 == $status) {
    print_r(json_decode($result, true));
} else {
    print $result;
}
print PHP_EOL;
~~~

API keys can be reviewed / deleted through the console interface. Run `php -f src/console.php list` to get a summary of the available commands.
