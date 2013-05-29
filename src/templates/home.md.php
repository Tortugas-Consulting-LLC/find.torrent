## GET
The root of the find.torrent service. Start here to browse the API.
### Responses
>### 200 OK
>State:
>~~~ json
>{
>  "welcome": "A configurable welcome message from the host of this service."
>}
>~~~
>Links:
>
>* [ft:about](/rels/about) Information about find.torrent.
>* [ft:feeds](/rels/feeds) The different RSS feeds parsed by this service.
>* [ft:search](/rels/search) The method to start searching for torrents.
