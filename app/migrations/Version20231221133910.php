<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231221133910 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bitrix (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, domain_url VARCHAR(100) NOT NULL, plan_id VARCHAR(10) DEFAULT NULL, member_id VARCHAR(50) NOT NULL, access_token VARCHAR(50) NOT NULL, refresh_token VARCHAR(50) NOT NULL, expires_on INT NOT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_3915B8DB7597D3FE (member_id), UNIQUE INDEX UNIQ_3915B8DB19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, access_token VARCHAR(50) NOT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE event (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, type_id VARCHAR(10) NOT NULL, stage_id VARCHAR(10) NOT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_3BAE0AA719EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE field (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, entity_id VARCHAR(10) NOT NULL, bitrix_id VARCHAR(10) NOT NULL, getresponse_id VARCHAR(10) NOT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_5BF5455819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE getresponse (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, plan_id VARCHAR(10) DEFAULT NULL, access_token VARCHAR(50) DEFAULT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_D3B0BB2819EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, list_id VARCHAR(10) DEFAULT NULL, pipeline_id VARCHAR(10) DEFAULT NULL, executed_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_2D737AEF19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bitrix ADD CONSTRAINT FK_3915B8DB19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE event ADD CONSTRAINT FK_3BAE0AA719EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE field ADD CONSTRAINT FK_5BF5455819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE getresponse ADD CONSTRAINT FK_D3B0BB2819EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE bitrix DROP FOREIGN KEY FK_3915B8DB19EB6921');
        $this->addSql('ALTER TABLE event DROP FOREIGN KEY FK_3BAE0AA719EB6921');
        $this->addSql('ALTER TABLE field DROP FOREIGN KEY FK_5BF5455819EB6921');
        $this->addSql('ALTER TABLE getresponse DROP FOREIGN KEY FK_D3B0BB2819EB6921');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF19EB6921');
        $this->addSql('DROP TABLE bitrix');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE event');
        $this->addSql('DROP TABLE field');
        $this->addSql('DROP TABLE getresponse');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
