<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200611085838 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE live DROP FOREIGN KEY FK_530F2CAF67B3B43D');
        $this->addSql('DROP INDEX IDX_530F2CAF67B3B43D ON live');
        $this->addSql('ALTER TABLE live CHANGE users_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE live ADD CONSTRAINT FK_530F2CAFA76ED395 FOREIGN KEY (user_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_530F2CAFA76ED395 ON live (user_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE live DROP FOREIGN KEY FK_530F2CAFA76ED395');
        $this->addSql('DROP INDEX IDX_530F2CAFA76ED395 ON live');
        $this->addSql('ALTER TABLE live CHANGE user_id users_id INT NOT NULL');
        $this->addSql('ALTER TABLE live ADD CONSTRAINT FK_530F2CAF67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_530F2CAF67B3B43D ON live (users_id)');
    }
}
