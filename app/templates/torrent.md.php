## GET
A found torrent. Contains information about a found torrent and the link to trigger its download.
### Responses
>Required Properties:
>
>* **title**: String
  * The descriptive name of the torrent
>* **target**: String
  * The URL where the torrent file can be downloaded.  This is used in conjuction with [ft:download](/rels/download)
>
>Example:
>~~~ json
>{
>  "title": "Dave - King of the trowsers - 128kbps plus covers - ANGRY GENTLEMEN RECORDS",
>  "target": "http://www.mininova.org/get/2461403",
>}
>~~~
>Links:
>
>* [ft:download](/rels/download) The link to trigger find.torrent to download this torrent
