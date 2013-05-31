## GET
A specific RSS feed that the find.torrent service knows how to parse.
### Responses
>### 200 OK
>#### Required Properties
>* **name**: string
  * Common name of this feed
>* **url**: string
  * Url where a human can go to browse this site themselves
>* **enabled**: boolean
  * Flag to say whether or not this feed is parsed when find.torrent searches. See [ft:search](/rels/search)
>#### Example
>~~~ json
>{
>  "name": "Kick Ass Torrents",
>  "url": "http://kat.ph",
>  "enabled": true
>}
>~~~

## PUT
Update a configured RSS feed. Used to set the enable/disable flag so a feed is or is not included in search operations.
### Body
#### Optional Properties
* **enabled**: boolean
#### Example
>~~~json
>{
>  "enabled": true
>}
>~~~
### Responses
>### 200 OK
>State:
>
> Same as GET result 200, including updated configuration.
