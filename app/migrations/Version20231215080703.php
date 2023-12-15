<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231215080703 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bitrix (id INT AUTO_INCREMENT NOT NULL, member_id VARCHAR(20) NOT NULL, access_token VARCHAR(20) NOT NULL, refresh_token VARCHAR(20) NOT NULL, expires_on INT NOT NULL, plan VARCHAR(20) DEFAULT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, bitrix_id INT NOT NULL, app_token VARCHAR(20) NOT NULL, app_domain VARCHAR(50) DEFAULT NULL, app_version INT DEFAULT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_C7440455A65CDF83 (bitrix_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE getresponse (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, access_token VARCHAR(20) DEFAULT NULL, plan VARCHAR(20) DEFAULT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D3B0BB2819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455A65CDF83 FOREIGN KEY (bitrix_id) REFERENCES bitrix (id)');
        $this->addSql('ALTER TABLE getresponse ADD CONSTRAINT FK_D3B0BB2819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF19EB6921');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455A65CDF83');
        $this->addSql('ALTER TABLE getresponse DROP FOREIGN KEY FK_D3B0BB2819EB6921');
        $this->addSql('DROP TABLE bitrix');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE getresponse');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
