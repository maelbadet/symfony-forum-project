<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240409145751 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE board (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE board_category (board_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_96BB1A78E7EC5785 (board_id), INDEX IDX_96BB1A7812469DE2 (category_id), PRIMARY KEY(board_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, role_access VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, user_entity_id INT DEFAULT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME NOT NULL, INDEX IDX_B6BD307F81C5F0B9 (user_entity_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE topic (id INT AUTO_INCREMENT NOT NULL, user_entity_id INT DEFAULT NULL, board_id INT DEFAULT NULL, title VARCHAR(100) NOT NULL, content VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, deleted_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_9D40DE1B81C5F0B9 (user_entity_id), INDEX IDX_9D40DE1BE7EC5785 (board_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(100) NOT NULL, role VARCHAR(100) NOT NULL, is_blocked TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE board_category ADD CONSTRAINT FK_96BB1A78E7EC5785 FOREIGN KEY (board_id) REFERENCES board (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE board_category ADD CONSTRAINT FK_96BB1A7812469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE message ADD CONSTRAINT FK_B6BD307F81C5F0B9 FOREIGN KEY (user_entity_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1B81C5F0B9 FOREIGN KEY (user_entity_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE topic ADD CONSTRAINT FK_9D40DE1BE7EC5785 FOREIGN KEY (board_id) REFERENCES board (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE board_category DROP FOREIGN KEY FK_96BB1A78E7EC5785');
        $this->addSql('ALTER TABLE board_category DROP FOREIGN KEY FK_96BB1A7812469DE2');
        $this->addSql('ALTER TABLE message DROP FOREIGN KEY FK_B6BD307F81C5F0B9');
        $this->addSql('ALTER TABLE topic DROP FOREIGN KEY FK_9D40DE1B81C5F0B9');
        $this->addSql('ALTER TABLE topic DROP FOREIGN KEY FK_9D40DE1BE7EC5785');
        $this->addSql('DROP TABLE board');
        $this->addSql('DROP TABLE board_category');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE topic');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
