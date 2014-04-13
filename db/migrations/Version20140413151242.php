<?php

namespace FindDotTorrent\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140413151242 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->connection->insert(
            'feeds',
            array('label' => 'KickAss', 'enabled' => true)
        );

        $this->connection->insert(
            'feeds',
            array('label' => 'Mininova', 'enabled' => true)
        );
    }

    public function down(Schema $schema)
    {
        $this->connection->delete(
            'feeds',
            array('label' => 'KickAss')
        );

        $this->connection->delete(
            'feeds',
            array('label' => 'Mininova')
        );
    }
}
