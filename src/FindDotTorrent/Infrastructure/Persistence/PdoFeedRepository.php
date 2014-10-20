<?php

namespace FindDotTorrent\Infrastructure\Persistence;

use Doctrine\DBAL\Connection;
use FindDotTorrent\Domain;

class PdoFeedRepository implements Domain\FeedRepository
{
    /**
     * @var Connection
     */
    protected $db;

    /**
     * @var Domain\Feed\Factory
     */
    protected $factory;

    /**
     * @param Connection $db
     * @pararm Domain\Feed\Factory $factory
     */
    public function __construct(Connection $db, Domain\Feed\Factory $factory)
    {
        $this->db = $db;
        $this->factory = $factory;
    }

    /**
     * @{inheritDoc}
     */
    public function all()
    {
        $results = $this->db->fetchAll('SELECT label, enabled FROM feeds');

        return $this->getFeeds($results);
    }

    /**
     * @{inheritDoc}
     */
    public function getEnabled()
    {
        $results = $this->db->fetchAll('SELECT label, enabled FROM feeds WHERE enabled = 1');

        return $this->getFeeds($results);
    }

    /**
     * @{inheritDoc}
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
     * @{inheritDoc}
     */
    public function setStatus(Domain\Feed $feed, $enabled)
    {
        $this->db->update(
            'feeds',
            array('enabled' => (bool) $enabled),
            array('label' => $feed->getLabel())
        );
    }

    /**
     * A helper method that transforms a list of feed labels into Domain\Feed
     * objects
     *
     * @param array $feeds
     * @return array An array of Domain\Feed objects
     */
    protected function getFeeds($feeds)
    {
        return array_map(function ($feed) {
            return $this->factory->build($feed);
        }, $feeds);
    }
}