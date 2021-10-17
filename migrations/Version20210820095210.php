<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820095210 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP INDEX IDX_6D28840D8D9F6D38, ADD UNIQUE INDEX UNIQ_6D28840D8D9F6D38 (order_id)');
        $this->addSql('ALTER TABLE payment CHANGE order_id order_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE payment DROP INDEX UNIQ_6D28840D8D9F6D38, ADD INDEX IDX_6D28840D8D9F6D38 (order_id)');
        $this->addSql('ALTER TABLE payment CHANGE order_id order_id CHAR(36) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
    }
}
