<?php

namespace FindDotTorrent\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140412103646 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $table = $schema->createTable('feeds');
        $table->addColumn('label', 'string');
        $table->addColumn('enabled', 'boolean', array('default' => true));
        $table->setPrimaryKey(array('label'));
    }

    public function down(Schema $schema)
    {
        $schema->dropTable('feeds');
    }
}
