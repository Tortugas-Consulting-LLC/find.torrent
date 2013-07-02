<?php

namespace FindDotTorrent\Feeds;

class Fetch
{
    final public static function fetchResults($term, IFeed $feed)
    {
        $url = $feed->makeSearchUrl($term);

        $request = curl_init();
        curl_setopt($request, CURLOPT_ENCODING, "gzip");
        curl_setopt($request, CURLOPT_HEADER, 0);
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($request, CURLOPT_URL, $url);
        curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($request);
        curl_close($request);

        return $feed->fetchResults($data);
    }

    final public static function fetchTorrent($target)
    {
        $ch = curl_init($target);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'find.torrent');

        $data = curl_exec($ch);

        curl_close($ch);

        // This returns false on failure, or the number of bytes that were written.
        file_put_contents('/Users/keelerm84/Sites/find.torrent/downloads/testing.torrent', $data);
    }
}
