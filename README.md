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
Edit `src/config/config.example.ini` then copy it to `src/config/config.ini`.

API Documentation
-----------------
A complete record of the API calls serviced by find.torrent is included here. Example data is used for context. Responses are in either [application/hal+json or application/hal+xml](http://stateless.co/hal_specification.html)

Documentation for the service's API is provided in the following form.

`HTTP METHOD /route/`
```json
{
  "JSON respone": "Huzzah!"
}
```

---

`GET /`
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
    "self": { "href": "/" },
    "ft:about": { "href": "/about/" },
    "ft:feeds": { "href": "/feeds/" },
    "ft:search": { "href": "/feeds/search/{?term}", "templated": true }
  },
  "welcome": "Welcome to the find.torrent service"
}
```

---

`GET /about/`
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
    "self": { "href": "/about/" },
    "ft:home": { "href": "/" }
  },
  "service": "find.torrent",
  "about": "The find.torrent service is an open source project from Tortugas Consulting, LLC",
  "version": "0.0.1"
}
```

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
    "feeds": [
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
          "ft:search": { "href": "/feeds/1/search/{?term}", "templated": true }
        },
        "title": "Kick Ass Torrents",
        "url": "http://kat.ph"
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
          "ft:search": { "href": "/feeds/2/search/{?term}", "templated": true }
        },
        "title": "The Pirate Bay",
        "url": "http://thepiratebay.se"
      }
    ]
  }
}
```

---

`GET /feeds/search/{term}`  
`GET /feeds/id/search/{term}`  
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
    "ft:results": [
       {
         "_links": {
           "curies": [
             {
               "name": "ft",
               "href": "*protocol*://*domain*:*port*/rels/{rel}",
               "templated": true
             }
           ],
           "ft:result": {
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
          "ft:result": {
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
