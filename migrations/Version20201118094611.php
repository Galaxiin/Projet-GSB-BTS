<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201118094611 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE composant (id INT AUTO_INCREMENT NOT NULL, cmp_auteur_id INT NOT NULL, cmp_code INT NOT NULL, cmp_libelle VARCHAR(255) NOT NULL, INDEX IDX_EC8486C93A3F698A (cmp_auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE constituer (id INT AUTO_INCREMENT NOT NULL, med_depot_legal_id INT NOT NULL, cmp_code_id INT NOT NULL, cst_qte INT NOT NULL, INDEX IDX_5616A926F74A57DB (med_depot_legal_id), INDEX IDX_5616A92640BBCDC3 (cmp_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dosage (id INT AUTO_INCREMENT NOT NULL, dos_code INT NOT NULL, dos_quantite INT NOT NULL, dos_unite VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE famille (id INT AUTO_INCREMENT NOT NULL, fam_auteur_id INT NOT NULL, fam_code INT NOT NULL, fam_libelle VARCHAR(255) NOT NULL, INDEX IDX_2473F21347781ED4 (fam_auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament (id INT AUTO_INCREMENT NOT NULL, med_auteur_id INT NOT NULL, med_depot_legal VARCHAR(255) NOT NULL, med_nom_commercial VARCHAR(255) NOT NULL, med_composition VARCHAR(255) NOT NULL, med_effets VARCHAR(255) NOT NULL, med_contre_indic VARCHAR(255) DEFAULT NULL, med_prix_echantillon DOUBLE PRECISION NOT NULL, INDEX IDX_9A9C723AD8FAA48D (med_auteur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament_presentation (medicament_id INT NOT NULL, presentation_id INT NOT NULL, INDEX IDX_31EE65EBAB0D61F7 (medicament_id), INDEX IDX_31EE65EBAB627E8B (presentation_id), PRIMARY KEY(medicament_id, presentation_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medicament_medicament (medicament_source INT NOT NULL, medicament_target INT NOT NULL, INDEX IDX_534FDD6C2A4B05F7 (medicament_source), INDEX IDX_534FDD6C33AE5578 (medicament_target), PRIMARY KEY(medicament_source, medicament_target)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE password_update (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prescrire (id INT AUTO_INCREMENT NOT NULL, med_depot_legal_id INT NOT NULL, tin_code_id INT NOT NULL, dos_code_id INT NOT NULL, pre_posologie VARCHAR(255) DEFAULT NULL, INDEX IDX_D494463DF74A57DB (med_depot_legal_id), INDEX IDX_D494463DAA9F2512 (tin_code_id), INDEX IDX_D494463D54F834B8 (dos_code_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presentation (id INT AUTO_INCREMENT NOT NULL, pre_code INT NOT NULL, pre_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role_user (role_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_332CA4DDD60322AC (role_id), INDEX IDX_332CA4DDA76ED395 (user_id), PRIMARY KEY(role_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_individu (id INT AUTO_INCREMENT NOT NULL, tin_code INT NOT NULL, tin_libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE composant ADD CONSTRAINT FK_EC8486C93A3F698A FOREIGN KEY (cmp_auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE constituer ADD CONSTRAINT FK_5616A926F74A57DB FOREIGN KEY (med_depot_legal_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE constituer ADD CONSTRAINT FK_5616A92640BBCDC3 FOREIGN KEY (cmp_code_id) REFERENCES composant (id)');
        $this->addSql('ALTER TABLE famille ADD CONSTRAINT FK_2473F21347781ED4 FOREIGN KEY (fam_auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE medicament ADD CONSTRAINT FK_9A9C723AD8FAA48D FOREIGN KEY (med_auteur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE medicament_presentation ADD CONSTRAINT FK_31EE65EBAB0D61F7 FOREIGN KEY (medicament_id) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicament_presentation ADD CONSTRAINT FK_31EE65EBAB627E8B FOREIGN KEY (presentation_id) REFERENCES presentation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicament_medicament ADD CONSTRAINT FK_534FDD6C2A4B05F7 FOREIGN KEY (medicament_source) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medicament_medicament ADD CONSTRAINT FK_534FDD6C33AE5578 FOREIGN KEY (medicament_target) REFERENCES medicament (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE prescrire ADD CONSTRAINT FK_D494463DF74A57DB FOREIGN KEY (med_depot_legal_id) REFERENCES medicament (id)');
        $this->addSql('ALTER TABLE prescrire ADD CONSTRAINT FK_D494463DAA9F2512 FOREIGN KEY (tin_code_id) REFERENCES type_individu (id)');
        $this->addSql('ALTER TABLE prescrire ADD CONSTRAINT FK_D494463D54F834B8 FOREIGN KEY (dos_code_id) REFERENCES dosage (id)');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDD60322AC FOREIGN KEY (role_id) REFERENCES role (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE role_user ADD CONSTRAINT FK_332CA4DDA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE constituer DROP FOREIGN KEY FK_5616A92640BBCDC3');
        $this->addSql('ALTER TABLE prescrire DROP FOREIGN KEY FK_D494463D54F834B8');
        $this->addSql('ALTER TABLE constituer DROP FOREIGN KEY FK_5616A926F74A57DB');
        $this->addSql('ALTER TABLE medicament_presentation DROP FOREIGN KEY FK_31EE65EBAB0D61F7');
        $this->addSql('ALTER TABLE medicament_medicament DROP FOREIGN KEY FK_534FDD6C2A4B05F7');
        $this->addSql('ALTER TABLE medicament_medicament DROP FOREIGN KEY FK_534FDD6C33AE5578');
        $this->addSql('ALTER TABLE prescrire DROP FOREIGN KEY FK_D494463DF74A57DB');
        $this->addSql('ALTER TABLE medicament_presentation DROP FOREIGN KEY FK_31EE65EBAB627E8B');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDD60322AC');
        $this->addSql('ALTER TABLE prescrire DROP FOREIGN KEY FK_D494463DAA9F2512');
        $this->addSql('ALTER TABLE composant DROP FOREIGN KEY FK_EC8486C93A3F698A');
        $this->addSql('ALTER TABLE famille DROP FOREIGN KEY FK_2473F21347781ED4');
        $this->addSql('ALTER TABLE medicament DROP FOREIGN KEY FK_9A9C723AD8FAA48D');
        $this->addSql('ALTER TABLE role_user DROP FOREIGN KEY FK_332CA4DDA76ED395');
        $this->addSql('DROP TABLE composant');
        $this->addSql('DROP TABLE constituer');
        $this->addSql('DROP TABLE dosage');
        $this->addSql('DROP TABLE famille');
        $this->addSql('DROP TABLE medicament');
        $this->addSql('DROP TABLE medicament_presentation');
        $this->addSql('DROP TABLE medicament_medicament');
        $this->addSql('DROP TABLE password_update');
        $this->addSql('DROP TABLE prescrire');
        $this->addSql('DROP TABLE presentation');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE role_user');
        $this->addSql('DROP TABLE type_individu');
        $this->addSql('DROP TABLE user');
    }
}
