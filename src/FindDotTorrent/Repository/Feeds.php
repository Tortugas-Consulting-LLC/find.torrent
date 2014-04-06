<?php

namespace FindDotTorrent\Repository;

use Doctrine\DBAL\Connection;
use FindDotTorrent\Feed\Factory;

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
        $results = $this->db->fetchAll('SELECT label FROM feeds');

        $labels = array_column($results, 'label');

        return $this->getFeeds($labels);
    }

    /**
     * Retrieve all enabled feeds
     *
     * @return array An array of Feed objects
     */
    public function getEnabled()
    {
        $results = $this->db->fetchAll('SELECT label FROM feeds WHERE enabled = 1');

        $labels = array_column($results, 'label');

        return $this->getFeeds($labels);
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
            'SELECT label FROM feeds WHERE label = ?',
            array($label)
        );

        if (empty($result)) {
            return false;
        }

        return $this->getFeeds(array($label))[0];
    }

    public function getFeeds($labels)
    {
        return array_map(function ($label) {
            return $this->factory->build($label);
        }, $labels);
    }
}