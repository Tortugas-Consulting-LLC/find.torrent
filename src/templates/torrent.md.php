## GET
A found torrent. Contains information about a found torrent and the link to trigger its download.
### Responses
>### 200 OK
>State:
>~~~ json
>{
>  "name": "The name of the torrent.",
>  "hash": "The unique hash that identifies the torrent.",
>  "seeders": "The reported number of seeders represented as an integer.",
>  "leachers": "The reported number of leachers represented as an integer.",
>  "files": [
>    { "title" : "The title of one of the files in this torrent", "bytes" : "The size of this file represented as an integer number of bytes" }
>  ]
>}
>~~~
>Links:
>
>* [ft:download](/rels/download) The link to trigger find.torrent to download this torrent
