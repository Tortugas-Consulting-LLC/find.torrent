find.torrent
============

**Note: This service is not yet in a stable release state. The API is subject to change**

find.torrent is a service to facilitate the discovery and downloading of torrent files to a home server or leachbox. The service provides a REST API for searching configured torrent RSS feeds and triggering a file download at the server. Neither the torrent file nor its indicated content is returned to the client; the .torrent file is simply downloaded to a configured location at the server. Another service such as [Transmission](http://www.transmissionbt.com/) needs to be running on the server to process the downloaded .torrents for any additional action to be taken.

Requirements
------------
* PHP 5.4 (might backport to 5.3. Not tested)
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

Responses are in either [application/hal+json or application/hal+xml](http://stateless.co/hal_specification.html)

---

`GET /feeds/`

```json
{
  "_links": {
    "curies": [
      {
        "name": "ft",
        "href": "*protocol*://*domain*:*port*/rels/{rel}",
        "templated": true
      }
    ],
    "self": { "href": "/feeds/" },
    "ft:home": { "href": "/" },
    "ft:search": { "href": "/feeds/search/{?term}", "templated": true }
  },
  "_embedded": {
    "ft:feed": [
      {
        "_links": {
          "curies": [
            {
              "name": "ft",
              "href": "*protocol*://*domain*:*port*/rels/{rel}",
              "templated": true
            }
          ],
          "self": { "href": "/feeds/1" },
          "ft:enable": { "href": "/feeds/1/enable" },
          "ft:disable": { "href": "/feeds/1/disable" }
        },
        "title": "Kick Ass Torrents",
        "url": "http://kat.ph",
        "enabled": false
      },
      {
        "_links": {
          "curies": [
            {
              "name": "ft",
              "href": "*protocol*://*domain*:*port*/rels/{rel}",
              "templated": true
            }
          ],
          "self": { "href": "/feeds/2" },
          "ft:enable": { "href": "/feeds/2/enable" },
          "ft:disable": { "href": "/feeds/2/disable" }
        },
        "title": "The Pirate Bay",
        "url": "http://thepiratebay.se",
        "enabled": true
      }
    ]
  }
}
```

---

`GET /feeds/search/{term}`  
_Searched for term 'ubuntu'_

```json
{
  "_links": {
    "curies": [
      {
        "name": "ft",
        "href": "*protocol*://*domain*:*port*/rels/{rel}",
        "templated": true
      }
    ],
    "self": { "href": "/feeds/search/ubuntu" },
    "ft:home": { "href": "/" },
    "ft:feeds": { "href": "/feeds/" },
  },
  "_embedded": {
    "ft:result": [
       {
         "_links": {
           "curies": [
             {
               "name": "ft",
               "href": "*protocol*://*domain*:*port*/rels/{rel}",
               "templated": true
             }
           ],
           "ft:download": {
             "href": "/download/f36c92a8f78a1aff70a61a5f5bfe5e6757176133",
             "method": "PUT"
           }
         },
         "name": "ubuntu-12.10-desktop-amd64.iso",
         "hash": "f36c92a8f78a1aff70a61a5f5bfe5e6757176133",
         "files": [
           { "title": "ubuntu-12.10-desktop-amd64.iso", "bytes": 711983104 },
           { "title": "README", "bytes": 149 }
         ],
         "seeders": 12,
         "leachers": 4
      },
      {
        "_links": {
          "curies": [
            {
              "name": "ft",
              "href": "*protocol*://*domain*:*port*/rels/{rel}",
              "templated": true
            }
          ],
          "ft:download": {
            "href": "/download/daa7d9348b5d289a58b91c98483b17417b266ff",
            "method": "PUT"
          }
        },
        "name": "ubuntu-11.10-server-i386.iso",
        "hash": "daa7d9348b5d289a58b91c98483b17417b266ff",
        "files": [
          { "title": "ubuntu-11.10-server-i386.iso", "bytes": 791323718 },
          { "title": "README", "bytes": 192 }
        ],
        "seeders": 24,
        "leachers": 9
      }
    ]
  }
}
```

---

`PUT /download/{hash}`  
`PUT /download/daa7d9348b5d289a58b91c98483b17417b266ff`  

```json
{
    "status": 200,
    "message": "Success message",
    "error": "Error message"
}
```
