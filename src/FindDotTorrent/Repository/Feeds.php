<?php

namespace FindDotTorrent\Repository;

use Doctrine\DBAL\Connection;
use FindDotTorrent\Feed\Factory;
use FindDotTorrent\Feed;

class Feeds
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * @var Factory
     */
    protected $factory;

    /**
     * @param Connection $db
     * @pararm Factory $factory
     */
    public function __construct(Connection $db, Factory $factory)
    {
        $this->db = $db;
        $this->factory = $factory;
    }

    /**
     * Retrieve all feeds, regardless of whether or not they are enabled
     *
     * @return array An array of Feed objects
     */
    public function all()
    {
        $results = $this->db->fetchAll('SELECT label, enabled FROM feeds');

        return $this->getFeeds($results);
    }

    /**
     * Retrieve all enabled feeds
     *
     * @return array An array of Feed objects
     */
    public function getEnabled()
    {
        $results = $this->db->fetchAll('SELECT label, enabled FROM feeds WHERE enabled = 1');

        return $this->getFeeds($results);
    }

    /**
     * Retrieve the requested feed
     *
     * @param string $feed The name of the feed to retrieve
     * @return Feed|false
     */
    public function get($label)
    {
        $result = $this->db->fetchAssoc(
            'SELECT label, enabled FROM feeds WHERE label = ?',
            array($label)
        );

        if (empty($result)) {
            return false;
        }

        return $this->getFeeds(array($result))[0];
    }

    /**
     * Set the status of the specified feed
     *
     * @param Feed $feed The feed to set the status on
     * @param bool $enabled A boolean to represent that status of the feed
     */
    public function setStatus(Feed $feed, $enabled)
    {
        $this->db->update(
            'feeds',
            array('enabled' => (bool) $enabled),
            array('label' => $feed->getLabel())
        );
    }

    /**
     * A helper method that transforms a list of feed labels into Feed objects
     *
     * @param array $feeds
     * @return array An array of Feed objects
     */
    protected function getFeeds($feeds)
    {
        return array_map(function ($feed) {
            return $this->factory->build($feed);
        }, $feeds);
    }
}