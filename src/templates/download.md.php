## PUT
Triggers find.torrent to download a specific [ft:torrent](/rels/torrent).
### Request
>### Body
>#### Required Properties
>* **target**: string
  * The url of the torrent, as retrieved through [ft:search](/rels/search)
>#### Example
>~~~ json
>{
>  "target": "http://www.mininova.org/get/2461403"
>}
>~~~

### Responses
>### 200 OK
>#### Required Properties
>* **path**: string
  * The path to the torrent that was successfully downloaded
>#### Example:
>~~~ json
>{
>  "path": "/var/www/find.torrent/downloads/1203120948.3048234234089.torrent",
>}
>~~~
>### 500 INTERNAL SERVER ERROR
