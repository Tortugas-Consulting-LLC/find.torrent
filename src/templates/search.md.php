## GET
Instructs find.torrent to parse enabled feeds for torrents matching search criteria. This link is templated with a variable **term** which acts as your search terms.
### Responses
>### 200 OK
>Links:
>
>* [ft:home](/rels/home) The root URI of find.torrent.
>* [ft:feeds](/rels/feeds) The different RSS feeds parsed by this service.
>
>Embedded Resources:
>
>* [ft:torrent](/rels/torrent) An array of search results.
