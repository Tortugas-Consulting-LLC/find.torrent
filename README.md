find.torrent
============

**Note: This service is not yet in a stable release state. The API is subject to change**

find.torrent is a service to facilitate the discovery and downloading of torrent files to a home server or leachbox. The service provides a REST API for searching configured torrent RSS feeds and triggering a file download at the server. Neither the torrent file nor its indicated content is returned to the client; the .torrent file is simply downloaded to a configured location at the server. Another service such as [Transmission](http://www.transmissionbt.com/) needs to be running on the server to process the downloaded .torrents for any additional action to be taken.

Requirements
------------
* PHP 5.3+
* Composer for dependency management
    * Install with `curl -s http://getcomposer.org/installer | php`

Installation
------------
1. Clone this repo
2. Install dependencies
    * Run `php composer.phar install`

Configuration
-------------
Copy `src/config/config.example.ini` to `src/config/config.ini` and fill in the blanks.

API Documentation
-----------------
Documentation of the service can be found by browsing to /rels/.

Responses are in either [application/hal+json or application/hal+xml](http://stateless.co/hal_specification.html) depending on your `config.ini`.
