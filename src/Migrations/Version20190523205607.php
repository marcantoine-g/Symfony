<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190523205607 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE version (id INT AUTO_INCREMENT NOT NULL, commentaire_id INT DEFAULT NULL, numero INT NOT NULL, file VARCHAR(255) NOT NULL, is_valided TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_BF1CD3C3BA9CD190 (commentaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE version ADD CONSTRAINT FK_BF1CD3C3BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES commentaire (id)');
        $this->addSql('ALTER TABLE commentaire ADD commenter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCB4D5A9E2 FOREIGN KEY (commenter_id) REFERENCES version (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_67F068BCB4D5A9E2 ON commentaire (commenter_id)');
        $this->addSql('ALTER TABLE user ADD password VARCHAR(255) NOT NULL, DROP username, DROP userfirstname, CHANGE email email VARCHAR(180) NOT NULL, CHANGE roles roles JSON NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCB4D5A9E2');
        $this->addSql('DROP TABLE version');
        $this->addSql('DROP INDEX UNIQ_67F068BCB4D5A9E2 ON commentaire');
        $this->addSql('ALTER TABLE commentaire DROP commenter_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user ADD userfirstname VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE email email VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE roles roles VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, CHANGE password username VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
