<?php

namespace FindDotTorrent;

use FindDotTorrent\Feeds\BaseFeed;

/**
 * Class FeedHandler
 * @package FindDotTorrent
 */
class FeedHandler
{
    /**
     * @var \PDO
     */
    protected $db;

    /**
     * FeedHandler constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * @return array
     */
    public function findAll()
    {
        $feeds = array();
        $enabled_stmt = $this->db->prepare("SELECT enabled FROM feeds WHERE id = :id");
        foreach (glob(__DIR__ . "/Feeds/*.php") as $filename) {
            $feed_name = str_replace(".php", "", basename($filename));
            if (in_array($feed_name, array('IFeed', 'BaseFeed', 'Fetch', 'SearchResult'))) {
                continue;
            }
            $feed_name = "\\FindDotTorrent\\Feeds\\{$feed_name}";

            /** @var BaseFeed $feed */
            $feed = new $feed_name;

            // Check to see if this feed is enabled
            $enabled_result = $enabled_stmt->execute(array(":id" => $feed->getIdentifier()));
            $row = $enabled_stmt->fetch();

            // If there's no row or it's explicitly enabled then enable this
            // feed. Otherwise disable it. In the absence of a row in the db we
            // use default values.
            $feed->setEnabled(false === $row || 1 == $row['enabled'] ? true : false);

            $feeds[] = $feed;
        }

        return $feeds;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    public function find($id)
    {
        foreach ($this->findAll() as $feed) {
            if ($feed->getIdentifier() == $id) {
                return $feed;
            }
        }

        return false;
    }

    /**
     * @param $feed
     * @throws \Exception
     */
    public function persist($feed)
    {
        $statement = $this->db->prepare("REPLACE INTO feeds (id, enabled) VALUES (:id, :enabled)");
        /** @var BaseFeed $feed */
        $result = $statement->execute(array(
            ":id" => $feed->getIdentifier(),
            ":enabled" => $feed->getEnabled() ? 1 : 0
        ));

        if (false === $result) {
            throw new \Exception(var_export($statement->errorInfo(), true));
        }
    }
}
