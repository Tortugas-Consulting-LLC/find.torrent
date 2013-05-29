## GET
A specific RSS feed that the find.torrent service knows how to parse.
### Responses
>### 200 OK
>State:
>~~~ json
>{
>  "title": "The name of this feed.",
>  "url": "The address if you want to go parse this feed yourself.",
>  "enabled": "boolean true or false. Indicates if this feed is currently available to be parsed."
>}
>~~~
>Links:
>
>* [ft:enable](/rels/enable) Enable this feed
>* [ft:disable](/rels/disable) Disable this feed
