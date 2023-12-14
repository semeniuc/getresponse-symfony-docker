<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214141928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, section_id INT NOT NULL, type VARCHAR(20) NOT NULL, stage VARCHAR(20) NOT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3BAE0AA7D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE field (id INT AUTO_INCREMENT NOT NULL, section_id INT NOT NULL, entity VARCHAR(20) NOT NULL, bitrix VARCHAR(20) NOT NULL, getresponse VARCHAR(20) NOT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5BF54558D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, list VARCHAR(20) DEFAULT NULL, pipeline VARCHAR(20) DEFAULT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_2D737AEF19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA7D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF54558D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA7D823E37A');
        $this->addSql('ALTER TABLE field DROP FOREIGN KEY FK_5BF54558D823E37A');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF19EB6921');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP TABLE section');
    }
}
