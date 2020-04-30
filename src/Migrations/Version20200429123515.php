<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200429123515 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE distibutor (id INT AUTO_INCREMENT NOT NULL, uuid VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, firm VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_6EC0142DD17F50A6 (uuid), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specs (id INT AUTO_INCREMENT NOT NULL, screen_size VARCHAR(255) NOT NULL, ram VARCHAR(255) NOT NULL, battery VARCHAR(255) NOT NULL, release_date DATE DEFAULT NULL, photo_sensor VARCHAR(255) NOT NULL, dual_sim TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, distibutor_id INT DEFAULT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_8D93D649E31E0508 (distibutor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649E31E0508 FOREIGN KEY (distibutor_id) REFERENCES distibutor (id)');
        $this->addSql('ALTER TABLE phones ADD specs_id INT DEFAULT NULL, ADD supplier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE phones ADD CONSTRAINT FK_E3282EF5CDB41915 FOREIGN KEY (specs_id) REFERENCES specs (id)');
        $this->addSql('ALTER TABLE phones ADD CONSTRAINT FK_E3282EF52ADD6D8C FOREIGN KEY (supplier_id) REFERENCES supplier (id)');
        $this->addSql('CREATE INDEX IDX_E3282EF5CDB41915 ON phones (specs_id)');
        $this->addSql('CREATE INDEX IDX_E3282EF52ADD6D8C ON phones (supplier_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649E31E0508');
        $this->addSql('ALTER TABLE phones DROP FOREIGN KEY FK_E3282EF5CDB41915');
        $this->addSql('ALTER TABLE phones DROP FOREIGN KEY FK_E3282EF52ADD6D8C');
        $this->addSql('DROP TABLE distibutor');
        $this->addSql('DROP TABLE specs');
        $this->addSql('DROP TABLE supplier');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP INDEX IDX_E3282EF5CDB41915 ON phones');
        $this->addSql('DROP INDEX IDX_E3282EF52ADD6D8C ON phones');
        $this->addSql('ALTER TABLE phones DROP specs_id, DROP supplier_id');
    }
}
