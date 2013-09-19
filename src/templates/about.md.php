## GET
Provides information about the find.torrent service.
### Responses
>### 200 OK
>Required Properties:
>
>* **service**: string
  * The awesome name of this service.,
>* **about**: string
  * A helpful message about this service.,
>* **version**: string
  * The version number of the installed service.
>
>Example:
>~~~ json
>{
>  "service": "find.torrent",
>  "about": "This service is brought to you by the letters F and T",
>  "version": "1.2.3"
>}
>~~~
>Links:
>
>* [ft:home](/rels/home) The root URI of find.torrent.
