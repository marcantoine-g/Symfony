<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523140633 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6498ADDF3C3');
        $this->addSql('DROP INDEX IDX_8D93D6498ADDF3C3 ON user');
        $this->addSql('ALTER TABLE user CHANGE gestion_id conseiller_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6491AC39A0D FOREIGN KEY (conseiller_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6491AC39A0D ON user (conseiller_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6491AC39A0D');
        $this->addSql('DROP INDEX IDX_8D93D6491AC39A0D ON user');
        $this->addSql('ALTER TABLE user CHANGE conseiller_id gestion_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6498ADDF3C3 FOREIGN KEY (gestion_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6498ADDF3C3 ON user (gestion_id)');
    }
}
