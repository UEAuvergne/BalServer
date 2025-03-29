<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250329004630 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE book_data (ean VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, author_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(ean))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE book_instance (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, data_id VARCHAR(255) NOT NULL, owner_id INTEGER NOT NULL, price INTEGER NOT NULL, status VARCHAR(255) NOT NULL, CONSTRAINT FK_5BCFA78737F5A13C FOREIGN KEY (data_id) REFERENCES book_data (ean) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_5BCFA7877E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5BCFA78737F5A13C ON book_instance (data_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5BCFA7877E3C61F9 ON book_instance (owner_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE owner (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, first_name VARCHAR(255) DEFAULT NULL, last_name VARCHAR(255) DEFAULT NULL, contact VARCHAR(255) DEFAULT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
            , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
            )
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE book_data
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE book_instance
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE owner
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
