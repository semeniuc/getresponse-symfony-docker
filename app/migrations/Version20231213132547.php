<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213132547 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE access (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, bitrix_token VARCHAR(100) NOT NULL, bitrix_refresh_token VARCHAR(100) NOT NULL, bitrix_expires_token INT NOT NULL, getresponse_token VARCHAR(100) DEFAULT NULL, app_token VARCHAR(100) NOT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_6692B5419EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, bitrix_id VARCHAR(100) NOT NULL, bitrix_domain VARCHAR(100) NOT NULL, bitrix_plan VARCHAR(20) DEFAULT NULL, getresponse_plan VARCHAR(20) DEFAULT NULL, app_version INT DEFAULT NULL, app_instaled TINYINT(1) DEFAULT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE access ADD CONSTRAINT FK_6692B5419EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE access DROP FOREIGN KEY FK_6692B5419EB6921');
        $this->addSql('DROP TABLE access');
        $this->addSql('DROP TABLE client');
    }
}
