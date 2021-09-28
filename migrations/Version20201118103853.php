<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118103853 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE password_update');
        $this->addSql('ALTER TABLE medicament ADD med_famille_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723A4D7F829F FOREIGN KEY (med_famille_id) REFERENCES famille (id)');
        $this->addSql('CREATE INDEX IDX_9A9C723A4D7F829F ON medicament (med_famille_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE password_update (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723A4D7F829F');
        $this->addSql('DROP INDEX IDX_9A9C723A4D7F829F ON medicament');
        $this->addSql('ALTER TABLE medicament DROP med_famille_id');
    }
}
