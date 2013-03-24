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
A complete record of the API calls serviced by find.torrent is included here. Example data is used for context. Responses are of the type [application/hal+json](http://stateless.co/hal_specification.html)

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
    "self": { "href": "/" },
    "about": { "href": "/about/" },
    "feeds": { "href": "/feeds/" },
    "search": { "href": "/feeds/search/{?term}", "templated": true },
    "history": { "href": "/feeds/history/" }
  },
  "welcome": "Welcome to the find.torrent service"
}
```

---

`GET /about/`
```json
{
  "_links": {
    "self": { "href": "/about/" },
    "home": { "href": "/" }
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
    "self": { "href": "/feeds/" },
    "home": { "href": "/" },
    "search": { "href": "/feeds/search/{?term}", "templated": true },
    "history": { "href": "/feeds/history/" }
  },
  "_embedded": {
    "feeds": [
      {
        "_links": {
          "self": { "href": "/feeds/1" },
          "search": { "href": "/feeds/1/search/{?term}", "templated": true },
          "history": { "href": "/feeds/1/history/" }
        },
        "title": "Kick Ass Torrents",
        "url": "http://kat.ph"
      },
      {
        "_links": {
          "self": { "href": "/feeds/2" },
          "search": { "href": "/feeds/2/search/{?term}", "templated": true },
          "history": { "href": "/feeds/2/history/" }
        },
        "title": "The Pirate Bay",
        "url": "http://thepiratebay.se"
      }
    ]
  }
}
```

---

`GET /feeds/search/term`  
`GET /feeds/id/search/term`  
_Searched for term 'ubuntu'_

```json
{
  "_links": {
    "self": { "href": "/feeds/search/ubuntu" },
    "home": { "href": "/" },
    "feeds": { "href": "/feeds/" },
    "downloads" {[
        {
          "title": "f36c92a8f78a1aff70a61a5f5bfe5e6757176133",
          "href": "/download/",
          "method": "PUT",
          "body": {
              "hash": "f36c92a8f78a1aff70a61a5f5bfe5e6757176133"
          }
        },
        {
          "title": "daa7d9348b5d289a58b91c98483b17417b266ff",
          "href": "/download/",
          "method": "PUT",
          "body": {
              "hash": "daa7d9348b5d289a58b91c98483b17417b266ff"
          }
        },
    ]}
  },
  "_embedded": {
    "downloads": [
      {
        "title": "f36c92a8f78a1aff70a61a5f5bfe5e6757176133",
        "name": "ubuntu-12.10-desktop-amd64.iso",
        "files": [
          { "title": "ubuntu-12.10-desktop-amd64.iso", "bytes": 711983104 },
          { "title": "README", "bytes": 149 }
        ],
        "seeders": 12,
        "leachers": 4
      },
      {
        "title": "daa7d9348b5d289a58b91c98483b17417b266ff",
        "name": "ubuntu-11.10-server-i386.iso",
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

`GET /feeds/history`

```json
{
  "_links": {
    "self": { "href": "/feeds/history" },
    "home": { "href": "/" },
  },
  "_embedded": {
    "downloads": [
      {
        "_links": {
          "self": {"href": "/download/f36c92a8f78a1aff70a61a5f5bfe5e6757176133"}
        },
        "_embedded": {
          "feed": {
            "_links": {
              "self": { "href": "/feeds/2" },
              "search": { "href": "/feeds/2/search/{?term}", "templated": true },
              "history": { "href": "/feeds/2/history/" }
            },
            "title": "The Pirate Bay",
            "url": "http://thepiratebay.se",
          }
        },
        "title": "ubuntu-12.10-desktop-amd64.iso",
        "date": "2012-11-25 00:00:00"
      },
      {
        "_links": {
          "self": {"href": "/download/daa7d9348b5d289a58b91c98483b17417b266ff"}
        },
        "_embedded": {
          "feed": {
            "_links": {
              "self": { "href": "/feeds/2" },
              "search": { "href": "/feeds/2/search/{?term}", "templated": true },
              "history": { "href": "/feeds/2/history/" }
            },
            "title": "The Pirate Bay",
            "url": "http://thepiratebay.se",
          }
        },
        "title": "ubuntu-11.10-server-i386.iso",
        "date": "2012-11-25 00:00:00"
      }
    ]
  }
}
```

---

`GET /feeds/id/history`

```json
{
  "_links": {
    "self": { "href": "/feeds/1/history" },
    "home": { "href": "/" },
    "feed": { "href": "/feeds/1" }
  },
  "_embedded": {
    "downloads": [
      {
        "_links": {
          "self": {"href": "/download/f36c92a8f78a1aff70a61a5f5bfe5e6757176133"}
        },
        "title": "ubuntu-12.10-desktop-amd64.iso",
        "date": "2012-11-25 00:00:00"
      },
      {
        "_links": {
          "self": {"href": "/download/daa7d9348b5d289a58b91c98483b17417b266ff"}
        },
        "title": "ubuntu-11.10-server-i386.iso",
        "date": "2012-11-25 00:00:00"
      }
    ]
  }
}
```

---

`PUT /download/`  
*Request body in the form of:*  
```json
{
    "hash": "daa7d9348b5d289a58b91c98483b17417b266ff"
}
```

*Response:*  
```json
{
    "status": 200,
    "message": "Success message",
    "error": "Error message"
}
```
